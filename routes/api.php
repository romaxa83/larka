<?php

use Illuminate\Http\Request;

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


Route::post('register', 'Api\Auth\RegisterController@register')->name('api.register');

Route::post('login',['uses' => 'Api\Auth\LoginController@login', 'as' => 'api.login']);
Route::post('refresh-token',['uses' => 'Api\Auth\LoginController@refreshToken', 'as' => 'api.refresh.token']);

//BOOKS
Route::get('books/categories', 'Api\Books\CategoryController@index')->name('api.books.category');

Route::middleware('auth:api')->group(function () {

    Route::get('logout',['uses' => 'Api\Auth\LoginController@logout', 'as' => 'api.logout']);

});
