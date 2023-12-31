<?php

use App\Http\Controllers\AuthicationProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/register',function(){
   return view('register');
});

Route::get('/', function (Request $request) {
    if($request->session()->has('Customer')){
        return redirect('/backlink/dashboard/');
    }
    return view('welcome');
});



Route::post('/register-process/',[AuthicationProfileController::class,'RegisterNewCustomer']);
Route::post('/login-process/',[AuthicationProfileController::class,'LoginCustomer']);
Route::get('/logout/',[AuthicationProfileController::class,'LogoutCustomer']);
Route::get('/tabs/',function(){
    $students = json_decode(file_get_contents(storage_path() . "/images.json"), true);
    return view('tabs',['images' => $students]);
});


Route::middleware('CustomerVerified')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/backlink/dashboard/', 'home');
        Route::get('/backlink/seo/backlink/order/','createOrder');
        Route::get('/daplans/','daplans');
        Route::post('/add-da-process/','daprocess');
        Route::post('/da-cat-add-process/','daCat');
        Route::get('/da-plan-finder/','ajax_call_da_plan');
        Route::get('/order_category_finder/','ajax_call_category');
        Route::post('/order_category_finder/','addtocart');
        Route::get('/select/payement/{id}','paymentpage');
        Route::get('/clearorder/{id}','clearorder');
        Route::post('/charge/{ODI}','charge');
        Route::get('/thankyou/{id}','thankyou');
        Route::get('/backlink/reports','reports');
        Route::get('/backlink/ordersReport','orders');
        Route::get('/backlink/billing','billing');
        Route::get('/addfunds','funds');
        Route::post('/fundsprocess','fundsprocess');
        Route::get('/addfunds-status/{id}','fundsstatus');
        Route::get('/viewreport/{id}','orderDetails');
        Route::get('/backlinks/orders','adminorder');
        Route::get('/backlink/admin/order/viewreport/{id}','confrimorder');
        Route::get('/order/status/change','changeStatus');
        Route::get('/admin/accounts','accounts');
    });
});
