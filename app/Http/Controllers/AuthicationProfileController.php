<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthicationProfileController extends Controller
{
    //Register New Customer
    function RegisterNewCustomer(Request $request){
        if($request->isMethod('post')){
            $email_validation = DB::table('users')->where('email',$request['email'])->first();
            if($email_validation){
                return "Email Found";
            }
            else{
                $hash_password = Hash::make($request['password']);
                $customer = DB::table('users')->insert([
                    'password' => $hash_password,
                    'full_name' => $request['name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'credits'=> 0,
                    'is_verified' => false,
                    'status'=> "Active"
                ]);
                return "202";
            }
        }else{
            return false;
        }
    }

    //Login Customer
    function LoginCustomer(Request $request){
        $is_EmailExist = DB::table('users')->where('email',$request['email'])->first();
        if(!$is_EmailExist){
            return  "Email Not Found";
        }else{
            $user = DB::table('users')->where('email',$request['email'])->first();
            if(Hash::check($request['password'],$user->password)){
                $request->session()->put('Customer',$user);
                return "202";
            }else{
                return "User Not Found";
            }
        }
    }

    //logout
    function LogoutCustomer(Request $request){
        $request->session()->forget('Customer');
        $request->session()->flush();
        return redirect('/');
    }
}
