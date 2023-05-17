<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['GET','POST'],'/',[CustomerController::class,'register'])->name('customer.register');

Route::match(['GET','POST'],'/login',[HomeController::class,'login'])->name('login');
Route::match(['GET','POST'],'/customer-login',[CustomerController::class,'login'])->name('customer.login');

Route::get('/customer-dashbord',[CustomerController::class,'dashbord'])->name('customer.dashbord');
Route::post('/customer-order',[CustomerController::class,'order'])->name('customer.order');
Route::post('/customer-order-proceed',[CustomerController::class,'order_proceed'])->name('customer.order_proceed');
Route::get('/customer-logout',[CustomerController::class,'logout'])->name('customer.logout');

Route::get('/success',function(){
    return view('customer.success');
})->name('success');
Route::get('/not',function(){
    return view('customer.not');
})->name('not');

Route::middleware('logged')->group(function(){
    //dashbord
    Route::get('/dashbord',[HomeController::class,'index'])->name('dashbord');

    //coupen
    Route::get('/coupons',[CoupenController::class,'index'])->name('coupons');
    Route::get('/view-coupon{id}',[CoupenController::class,'view'])->name('coupon.view');
    Route::match(['GET','POST'],'/add-coupon',[CoupenController::class,'add'])->name('coupon.add');
    Route::match(['GET','POST'],'/edit-coupon{id}',[CoupenController::class,'edit'])->name('coupon.edit');

    //logout
    Route::get('/logout',[HomeController::class,'logout'])->name('logout');
});

