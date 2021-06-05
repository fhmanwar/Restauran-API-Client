<?php

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

// Route::get('/login','AuthController@login');
// Route::get('/register','AuthController@regis');

Route::prefix('admin')->group(function(){
    Route::get('/dasbor','AdminController@index');

    // Role
    Route::get('/level','AdminController@level');

    // User
    Route::get('/user','AdminController@user');

    // Product
    Route::get('/product','AdminController@product');

    // // Store
    // Route::get('/store','AdminController@store');

    // Route::get('/material','AdminController@material');
    // Route::get('/order','AdminController@order');
    // // Route::get('/orderid','AdminController@orderId');
    // Route::get('/orderid/{src?}', function(Request $req){
    //     // return $req->src;
    //     return view('sadmin.order.orderid', ['data' => $req->src]);
    // });
    // Route::get('/cart','AdminController@cart');

    // // Pembukuan
    // Route::prefix('pembukuan')->group(function() {
    //     // Route::get('/pembelian','AdminController@pembelian');
    //     Route::get('/sell','AdminController@sell');
    //     Route::get('/profit','AdminController@profit');

    // });
});
