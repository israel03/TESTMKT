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



Route::get('/', 'App\Http\Controllers\vistasController@viewBooks');
Route::get('/category', 'App\Http\Controllers\vistasController@viewCategory');
Route::get('/users', 'App\Http\Controllers\vistasController@viewUsers');


// Category
Route::post('saveCategory', 'App\Http\Controllers\categoryController@saveCategory');
Route::get('deleteCategory', 'App\Http\Controllers\categoryController@deleteCategory');


// Book
Route::post('saveBook', 'App\Http\Controllers\bookController@saveBook');
Route::get('deleteBook', 'App\Http\Controllers\bookController@deleteBook');
Route::post('reserveBook', 'App\Http\Controllers\bookController@reserveBook');
Route::get('deleteStatus', 'App\Http\Controllers\bookController@changeStatus');


// Book
Route::post('saveUser', 'App\Http\Controllers\userController@saveUser');
Route::get('deleteUser', 'App\Http\Controllers\userController@deleteUser');

