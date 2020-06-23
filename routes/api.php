<?php

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
Route::middleware(['auth:api', 'roles:Admin|Producteur'])->group(function () {
    Route::get('producers', 'ProducersController@getProducers');
});
Route::middleware(['auth:api', 'roles:Producteur'])->prefix('producers')->group(function () {
    Route::get('products', 'ProductController@getOfProducer');
    Route::post('products', 'ProductController@createOrUpdate');
});
Route::middleware(['auth:api', 'roles:Producteur|Client'])->group(function () {
    Route::post('orders', 'OrderController@create');
    /* Route::get('orders', '');
    Route::get('orders/{id}', '')->where('id', ''); */
    Route::post('orders/{id}/paiement', 'OrderController@paiement')->where('id', '[0-9]+');
});


Route::middleware('auth:api')->get('profil', 'UserController@index');

Route::get('products', 'ProductController@getProduct');
Route::get('fruits', 'FruitController@index');
Route::post('/login', 'AuthController@login');
Route::middleware('auth:api')->get('/logout', 'AuthController@logout');

