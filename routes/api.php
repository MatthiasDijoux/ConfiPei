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

Route::get('products', 'ProductController@getProduct');
Route::post('updateProduct', 'ProductController@createOrUpdate');
Route::get('Fruits', 'FruitController@index');
Route::post('/login', 'AuthController@login');
Route::middleware('auth:api')->get('/logout', 'AuthController@logout');
Route::post('uploadImage/{id}', 'imageController@imageUpload')->where('id', "[0-9]+");
