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

Route::get('/', function () {
    return view('welcome');
});

Route::match(['GET','POST'],'/login',[HomeController::class,'login'])->name('login');

Route::middleware('logged')->group(function(){
    //dashbord
    Route::get('/dashbord',[HomeController::class,'index'])->name('dashbord');

    //coupen
    Route::get('/coupons',[CoupenController::class,'index'])->name('coupons');
    Route::get('/view-coupon{id}',[CoupenController::class,'view'])->name('coupon.view');
    Route::match(['GET','POST'],'/add-coupon',[CoupenController::class,'add'])->name('coupon.add');

    //logout
    Route::get('/logout',[HomeController::class,'logout'])->name('logout');
});

