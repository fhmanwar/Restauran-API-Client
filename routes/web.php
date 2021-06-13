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
    return redirect()->route('login');
})->name('home');


Route::get('/tes','AuthController@tes');
Route::get('/login','AuthController@login')->name('login');
Route::get('/logout','AuthController@logout')->name('logout');
Route::post('/auth','AuthController@auth')->name('auth');
Route::get('/session','AuthController@tesSession')->name('tes');
// Route::get('/register','AuthController@regis');

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
    // Laporan
    Route::get('/laporan','AdminController@laporan');

    Route::get('/print/{id}', 'AdminController@print')->name('print');
});

Route::get('/home', 'HomeController@index')->name('home');
