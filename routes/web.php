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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('home');
});


Route::get('/testAuth','AuthController@tes');
Route::get('/login','AuthController@login')->name('login');
Route::get('/logout','AuthController@logout')->name('logout');
Route::post('/auth','AuthController@auth')->name('auth');
Route::get('/session','AuthController@tesSession')->name('tes');
Route::get('qrcode/{id}', 'UtilityController@generateQr');

Route::prefix('admin')->middleware(['roleAccess'])->group(function(){
    Route::get('/dasbor','AdminController@index')->name('dasbor');

    // Role
    Route::get('/level','AdminController@level');

    // User
    Route::get('/user','AdminController@user');

    // Product
    Route::get('/product','AdminController@product');

    // Order
    Route::get('/order','AdminController@order');
    // Transaksi
    Route::get('/transaksi','AdminController@transaction');

    Route::get('/print/{id}', 'AdminController@print')->name('print');
    Route::post('/excelMonth', 'AdminController@transaksiMonhtExcel')->name('excelMonth');
    Route::post('/excelDaily', 'AdminController@transaksiDailyExcel')->name('excelDaily');
});

Route::prefix('/')->group(function(){
    Route::get('tesUser', 'HomeController@index')->name('tesUser');

    Route::get('home', 'HomeController@katalog')->name('home');

    Route::get('customer/{id}', 'HomeController@setSessionCustomer');

    Route::get('cart/{id}', 'HomeController@cart')->name('cart');
    Route::post('addcart', 'HomeController@addCart')->name('addCart');

    Route::get('complete/{id}', 'HomeController@completeOder')->name('complete');
});


