<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/', [Controller::class, 'index']);
Route::get('/delivery', [Controller::class, 'delivery']);
Route::get('/contacts', [Controller::class, 'contacts']);
Route::get('/section/{id}', [Controller::class, 'section']);
Route::get('/product/{id}', [Controller::class, 'product']);
Route::get('/cart', [Controller::class, 'cart']);
Route::post('/cart', [Controller::class, 'cart']);
Route::get('/order', [Controller::class, 'order']);
Route::post('/order', [Controller::class, 'order']);
Route::get('/addorder/{id}', [Controller::class, 'addorder']);
Route::get('/search', [Controller::class, 'search']);
Route::get('language/{locale}', [Controller::class, 'language']);