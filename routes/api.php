<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Resources\ProductResource;
use App\Product;
use App\Http\Resources\ProductCollection;

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

Route::get('products', 'ProductController@index');
Route::post('orders', 'OrderController@store');
Route::post('messages', 'MessageController@store');

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', 'UserController@logout');
    Route::get('orders', 'OrderController@index');
});
