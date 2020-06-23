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

Route::get('/storage/images/{filename}', 'imageController@index');
Route::get('/testMail', function () {
    return new App\Mail\Contact([
        'nom' => 'toto',
        'email' => 'test.toto@gmail.com',
        'message' => 'bonjour voici le mail',
    ]);
});
Route::prefix('/')->group(function () {
    Route::get('/', 'ProductController@index');
    Route::get('/{any}', 'ProductController@index')->where('any', '.*');
});
