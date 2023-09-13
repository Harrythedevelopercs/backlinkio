<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Str;
use Stripe;


class DashboardController extends Controller
{



    function home(Request $request){
        $customer = $request->session()->get('Customer');
        $totalorders = DB::table('orders')->where('user_id',$customer->id)->where('status','paid')->count();
        // $pendingOrders = DB::table("cartitem")->where('user_id',$customer->id)->where('')
        return view('Templates.dashboard',['OnlineCustomer'=> $customer,'paidorders'=> $totalorders]);
    }

    function createOrder(Request $request){
        $customer = $request->session()->get('Customer');
        $da = DB::table('da')->orderBy('DA')->where('status','active')->get();
        $order_Number = Str::upper(Str::random(6)).':'.date("y").":".date("m");

        $cartItem = DB::table('cartitem')->orderBy('orderId')->where("user_id",'=',$customer->id)->where('order_date','=',date('d-m-Y'))->where('status','orderPending')->get();
        return view('Templates.seoproduct',['OnlineCustomer'=> $customer,'DA' => $da,'OrderNumber' => $order_Number,'CartItem'=> $cartItem]);
    }

    function ajax_call_da_plan(Request $request){
        $results = DB::table('dacategory')->where('da_id','=',$request['da'])->get();
        return $results;
    }

    function daplans(Request $request){
        $customer = $request->session()->get('Customer');
        $merge = [];
        $DA_records = DB::table('da')->get();
        foreach ($DA_records as $DA){
            $DA_Catrecords = DB::table('dacategory')->where('da_id',$DA->id)->get();
            array_push($merge , [
               'id'=> $DA->id,
                'DA' => $DA->DA,
                'Category' => $DA_Catrecords
            ]);
        }
     return view('Templates.plans',['OnlineCustomer'=> $customer,'DARECORDS' => $merge]);
    }

    function daprocess(Request $request){
        $DA = $request->da;
        $DA_Response = DB::table('da')->insert([
            'DA' => $DA,
            'status' => "Active"
        ]);

        return $DA_Response;
    }

    function daCat(Request $request){
        $DA_id = $request->da_id;
        $Cat_Response = DB::table('dacategory')->insert([
           'da_id' => $DA_id,
            'title' => $request->cat_Name,
            'price' => $request->cat_Price,
            'status' => "orderPending"
        ]);
        return $Cat_Response;
    }


    function ajax_call_category(Request $request){
        $cat = DB::table('dacategory')->join('da','da.id','=',"dacategory.da_id")->where('dacategory.id',$request->cat)->first();
        return $cat;
    }

    function addtocart(Request $request){

        $user = $request->session()->get('Customer');

        $cartItem = DB::table('cartitem')->insert([
            'orderID' => $request->order,
            'da' => $request->domain,
            'anchor' => $request->anchor,
            'URL' => $request->URL,
            'category' => $request->cateogry,
            'category_price' => $request->cateogry_price,
            'user_id' => $user->id,
            'order_date' => date('d-m-Y'),
            'status' => 'orderPending'
        ]);
        return $request->cateogry_price;
    }


    function clearorder(Request $req , $id){
        $delete = DB::table("cartitem")->where('orderID', '=', $id)->update([
            'status' => 'orderDraft'
        ]);
        if($delete){
            return redirect('/backlink/seo/backlink/order/');
        }
    }

    function paymentpage(Request $request,$id){
        $customer = $request->session()->get('Customer');
        $checkout = DB::table('cartitem')->where('orderID',$id)->get();
        $sum = DB::table('cartitem')->where('orderID',$id)->sum('category_price');
        return view('Templates.checkout',['OnlineCustomer'=> $customer,'checkout'=>$checkout,'sum'=>$sum,'ODI'=>$id]);
    }


    function charge(Request $request,$id){
        $sum = DB::table('cartitem')->where('orderID',$id)->sum('category_price');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customerID = $request->session()->get('Customer');
        $customer = Stripe\Customer::create(array(
            "email" => $request->input('customer-email'),
            "name" => $request->input('customer-fname') . $request->input('customer-lname'),
         ));
         
        $product = Stripe\Product::create([
            'name' => "$id",
        ]);

        $price = Stripe\Price::create([
            'unit_amount' => $sum * 100,
            'currency' => 'usd',
            'product' => $product->id,
        ]);

        
          $checkoutSession = Stripe\Checkout\Session::create([
            'line_items' => [
                [
                  'price' => $price->id,
                  'quantity' => 1,
                ],
              ],
              'customer_email' => $request->input('customer-email'),
              
              'success_url' => 'http://127.0.0.1:8000/thankyou/{CHECKOUT_SESSION_ID}',
              'mode' => 'payment',
          ]);
          $orders = DB::table('orders')->insert([
            "order_id" => $id,
            'user_id' => $customerID->id,
            "amount" =>  $sum ,
            "paymentLink" => $checkoutSession->url,
            "payment_ID" => $checkoutSession->id,
            "payment_status" => $checkoutSession->status,
            "payment_created" => date("m-d-Y"),
            "payment_paid_date" => date("m-d-Y"),
            "status" => "UNPAID"
          ]);
          
        return redirect($checkoutSession->url);
    } 

    function thankyou(Request $req,$id){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkoutSession = Stripe\Checkout\Session::retrieve($id);
        
        $sum = $checkoutSession->amount_total / 100 ;
        if($checkoutSession->payment_status == "paid"){
            $orders = DB::table('orders')->where('payment_ID',$checkoutSession->id)->update([
                "payment_status" => "complete",
                "payment_paid_date" => date("m-d-Y"),
                "status" => $checkoutSession->payment_status
              ]);
             $findorder = DB::table('orders')->select('order_id')->where('payment_ID',$checkoutSession->id)->get();
              DB::table('cartitem')->where('orderID',$findorder[0]->order_id)->update([
                 'status' => "orderPlaced"
             ]);
        }
        $req->Session()->flash("success","'Order Placed Thank You'");
        return redirect('/');
        
    }
}
