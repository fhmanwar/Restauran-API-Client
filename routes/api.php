<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login',[AuthController::class, 'login']);
Route::post('/auth/register',[AuthController::class, 'register']);

// Role
Route::get('/level/tes','API\LevelController@index');
Route::get('level','API\LevelController@getAll');
Route::get('level/{id}','API\LevelController@getId');
Route::post('level','API\LevelController@create');
Route::put('level/{id}','API\LevelController@update');
Route::delete('level/{id}','API\LevelController@destroy');

// User
Route::get('user/tes','API\UserController@index');
Route::get('user','API\UserController@getAll');
Route::get('user/{id}','API\UserController@getId');
Route::post('user',[UserController::class, 'create']);
Route::put('user/{id}',[UserController::class, 'update']);
Route::delete('user/{id}',[UserController::class, 'destroy']);

// Product
Route::get('product/tes','API\ProductController@index');
Route::get('product', 'API\ProductController@getAll');
Route::get('product/{id}','API\ProductController@getId');
Route::post('product','API\ProductController@create');
Route::put('product/{id}','API\ProductController@update');
Route::delete('product/{id}','API\ProductController@destroy');

// Transaction
Route::prefix('transaction')->group(function(){
    Route::get('/','API\TransactionController@index');

    // Cart
    Route::get('cart/{id}', 'API\TransactionController@cartUserId');
    Route::get('cartid/{id}', 'API\TransactionController@cartById');
    Route::post('addToCart', 'API\TransactionController@addToCart');
    Route::post('updCart', 'API\TransactionController@updCart');
    Route::delete('delCartId/{id}','API\TransactionController@delCartById');

    Route::post('order', 'API\TransactionController@addOrder');
});
