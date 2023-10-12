<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Str;
use Stripe;
use Khill\Lavacharts\Lavacharts;

class DashboardController extends Controller
{



    function home(Request $request){
        $customer = $request->session()->get('Customer');
        $totalorders = DB::table('orders')
            ->where('user_id',$customer->id)
            ->where('status','paid')
            ->count();

        $orders = DB::table("orders")
            ->where('user_id',$customer->id)
            ->where('status','paid')
            ->get();

        return view('Templates.dashboard',['OnlineCustomer'=> $customer,'paidorders'=> $totalorders,'orders' => $orders]);
    }


    function reports(Request $request){
        $customer = $request->session()->get('Customer');
       
        $pendingOrders = DB::table("cartitem")
            ->select('orderId',"order_date","status")
            ->where('status','=', 'OrderPlaced')
            ->distinct()
            ->get();

        $completedOrders = DB::table("cartitem")
            ->select('orderId',"order_date","status")
            ->where('status','=', 'OrderComplete')
            ->distinct()
            ->get();
    
        return view('Templates.reports',['OnlineCustomer'=> $customer,'pendingOrders'=>$pendingOrders,'completedOrders'=>$completedOrders]);
    }


    function billing(Request $request){
        $customer = $request->session()->get('Customer');
        $totalorders = DB::table('orders')
            ->where('user_id',$customer->id)
            ->where('status','paid')
            ->sum('amount');
        $allorders  = DB::table('orders')
            ->where('user_id',$customer->id)
            ->where('status','paid')
            ->get();
            
        $allordersmonths  = DB::table('orders')
            ->where('user_id',$customer->id)
            ->where('status','paid')
            ->get();

        
        $fundsreport = DB::table('fundshistory')
            ->where('user_id',$customer->id)
            ->get();
            
        $total = count($allorders) - 1;
        $lastorder = $allorders[$total];
        $amounts = DB::table('funds')->where('user_id',$customer->id)->sum('amount');
        return view('Templates.billing',[
            'OnlineCustomer'=> $customer,
            'paidorderssum'=> $totalorders,
            'lastorder'=>$lastorder,
            'orders' => $allordersmonths,
            'amount'=> $amounts,
            'fundsreport' => $fundsreport,
        ]);
    }


    function orderDetails(Request $request,$id){
        $customer = $request->session()->get('Customer');
        $Order = DB::table('cartitem')->join('orders','orders.order_id','=','cartitem.orderId')->select('cartitem.id as CID','orders.*','cartitem.*')->where('cartitem.orderId',$id)->get();
        $totalOrderAmount = DB::table('cartitem')->where('orderId',$id)->sum('category_price');
        return view('Templates.viewReport',['OnlineCustomer'=> $customer,'OD'=> $id,'Order' => $Order,'TotalAmount'=>$totalOrderAmount]);
    }

    function funds(Request $request){
        $customer = $request->session()->get('Customer');
        
        return view('Templates.funds',['OnlineCustomer'=> $customer]);
    }
    
    function fundsprocess(Request $request){
        $customer = $request->session()->get('Customer');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $search_customer = Stripe\Customer::search([
            'query' => 'email:\''.$customer->email.'\'',
          ]);
        $product = Stripe\Product::create([
            'name' => "FUNDS FOR CUSTOMER $customer->email",
        ]);

        $price = Stripe\Price::create([
            'unit_amount' => $request->input('amount') * 100,
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
              
              'success_url' => 'http://127.0.0.1:8000/addfunds-status/{CHECKOUT_SESSION_ID}',
              'mode' => 'payment',
          ]);
    

        return redirect($checkoutSession->url);
    }


    function fundsstatus(Request $request,$id){
        $customer = $request->session()->get('Customer');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkoutSession = Stripe\Checkout\Session::retrieve($id);
        echo "<pre>";

        if($checkoutSession->payment_status == "paid"){
 
            $add_fund_history = DB::table('fundshistory')->insert([
                'user_id'    => $customer->id,
                'amount'     => $checkoutSession->amount_total,
                'stripe_ref' => $checkoutSession->id,
                'date'       => date('m-d-y  H:i:s'),
                'status'     => "Funds Added"
            ]);

           $checkuser = DB::table('funds')->where('user_id',$customer->id)->get();
           if(count($checkuser) > 0){
                $updatefunds = DB::table('funds')->where('user_id',$customer->id)->update([
                    'amount' => $checkoutSession->amount_total + $checkuser[0]->amount,
                    'last_update' => date('m-d-y  H:i:s'),
                ]);
           }else{
            $updatefunds = DB::table('funds')->insert([
                'user_id' => $customer->id,
                'amount' => $checkoutSession->amount_total,
                'topup_date' => date('m-d-y'),
                'status' => $checkoutSession->payment_status,
                'last_update' => date('m-d-y  H:i:s'),
            ]);
           }
        }

        if($updatefunds){
            return redirect('./backlink/billing');
        }

    }

    public function orders(Request $request){
        $customer = $request->session()->get('Customer');
       
        $orders = DB::table("orders")
        ->where('user_id',$customer->id)
        ->where('status','paid')
        ->get();
        return view('Templates.order',['OnlineCustomer'=> $customer,'orders' => $orders]);
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

        $customer = $request->session()->get('Customer');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkoutSession = Stripe\Checkout\Session::retrieve($id);
       
        $search_customer = Stripe\Customer::search([
            'query' => 'email:\''.$search_customer->data[0]->email.'\'',
        ]);
      
      
     

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



        $req->Session()->flash("success","Order Placed Thank You");
        return redirect('/');
        
    }

    function adminorder(Request $request){
        $customer = $request->session()->get('Customer');
       
        if($customer->is_verified != 10){
            return "No Access Bro";
        }
        else{
            $pendingOrders = DB::table("cartitem")
            ->select('orderId',"order_date","status")
            ->where('status','=', 'orderPlaced')
            ->distinct()
            ->get();

        $completedOrders = DB::table("cartitem")
            ->select('orderId',"order_date","status")
            ->where('status','=', 'OrderComplete')
            ->distinct()
            ->get();
    
        return view('Templates.adminorder',['OnlineCustomer'=> $customer,'pendingOrders'=>$pendingOrders,'completedOrders'=>$completedOrders]);
          
        }
        
    }


    function confrimorder(Request $request,$id){
        $customer = $request->session()->get('Customer');
       
        if($customer->is_verified != 10){
            return "No Access Bro";
        }
        else{
            $pendingOrders = DB::table("cartitem")
            ->select('orderId',"order_date","status")
            ->where('status','=', 'orderPlaced')
            ->distinct()
            ->get();
            $Order = DB::table('cartitem')->join('orders','orders.order_id','=','cartitem.orderId')->select('cartitem.id as CID','orders.*','cartitem.*')->where('cartitem.orderId',$id)->get();
            $totalOrderAmount = DB::table('cartitem')->where('orderId',$id)->sum('category_price');
          
        return view('Templates.confrimorder',['OnlineCustomer'=> $customer,'pendingOrders'=>$pendingOrders,'OD' => $id, "Order" => $Order,"TotalAmount" => $totalOrderAmount]);
          
        }
    }


    function changeStatus(Request $request){
        $productID = $request->input('productID');

        $updateCart = DB::table('cartitem')
        ->where('id',$productID)
        ->update([
            'responseURL' => $request->input('basic-url'),
            'status' => $request->input('productStatus')
        ]);

        return redirect()->back();
    }

   

}
