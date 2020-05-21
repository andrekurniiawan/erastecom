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

Route::resource('product', 'ProductController');
Route::get('trash/product', 'ProductController@trash')->name('product.trash');
Route::post('trash/product/{product}/restore', 'ProductController@restore')->name('product.restore');
Route::delete('trash/product/{product}/kill', 'ProductController@kill')->name('product.kill');

Route::resource('order', 'OrderController');
Route::resource('user', 'UserController');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
