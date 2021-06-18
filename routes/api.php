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
Route::prefix('level')->group(function(){
    Route::get('/tes','API\LevelController@index');
    Route::get('/','API\LevelController@getAll');
    Route::get('/{id}','API\LevelController@getId');
    Route::post('/','API\LevelController@create');
    Route::put('/{id}','API\LevelController@update');
    Route::delete('/{id}','API\LevelController@destroy');
});

// User
Route::prefix('user')->group(function(){
    Route::get('/tes','API\UserController@index');
    Route::get('/','API\UserController@getAll');
    Route::get('/{id}','API\UserController@getId');
    Route::post('/',[UserController::class, 'create']);
    Route::put('/{id}',[UserController::class, 'update']);
    Route::delete('/{id}',[UserController::class, 'destroy']);
});

// Product
Route::prefix('product')->group(function(){
    Route::get('tes','API\ProductController@index');
    Route::get('/', 'API\ProductController@getAll');
    Route::get('/{id}','API\ProductController@getId');
    Route::post('/','API\ProductController@create');
    Route::put('/{id}','API\ProductController@update');
    Route::delete('/{id}','API\ProductController@destroy');
});

// Cart
Route::prefix('cart')->group(function(){
    Route::get('/{id}', 'API\TransactionController@cartUserId');
    Route::get('cartid/{id}', 'API\TransactionController@cartById');
    Route::post('/', 'API\TransactionController@addToCart');
    Route::post('updCart', 'API\TransactionController@updCart');
    Route::delete('/{id}','API\TransactionController@delCartById');
});

// Order
Route::prefix('order')->group(function(){
    Route::get('/', 'API\TransactionController@getAllOrderByStatus');
    Route::get('/{id}', 'API\TransactionController@getIdOrderByStatus');
    Route::post('/', 'API\TransactionController@addOrder');
    Route::delete('del/{id}', 'API\TransactionController@delOrder');

    Route::get('orderdet/{id}', 'API\TransactionController@getOrderDetailByOrderId');
});

// Order Detail
Route::prefix('orderdet')->group(function(){
    Route::get('/{id}', 'API\TransactionController@getIdOrderDetail');
    Route::post('/', 'API\TransactionController@updOrderDetail');
    Route::delete('/{id}', 'API\TransactionController@delOrderDetail');
});

// Transaction
Route::prefix('transaction')->group(function(){
    Route::get('tes','API\TransactionController@index');
    Route::get('/', 'API\TransactionController@getAllTransaction');
    Route::get('det/{id}', 'API\TransactionController@getIdTransaction');
    Route::post('/', 'API\TransactionController@addTransaction');
});
