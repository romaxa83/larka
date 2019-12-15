<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('admin',['uses' => 'Admin\HomeController@index', 'as' => 'admin.home']);
    Route::get('admin/books/category',['uses' => 'Admin\Books\CategoryController@index', 'as' => 'admin.books.category']);
    Route::get('admin/books/category/create',['uses' => 'Admin\Books\CategoryController@create', 'as' => 'admin.books.category.create']);
    Route::post('admin/books/category/store',['uses' => 'Admin\Books\CategoryController@store', 'as' => 'admin.books.category.store']);

});


//Route::prefix('admin')->group(function(){
//    Route::middleware('auth')->group(function(){
//
//        Route::get('',['uses' => 'Admin\HomeController@index', 'as' => 'home']);
//
//
//        Route::prefix('books')->group(function(){
//            Route::get('/category',['uses' => 'Admin\Books\CategoryController@index', 'as' => 'category']);
//
//            Route::get('/category/create',['uses' => 'Admin\Books\CategoryController@create', 'as' => 'category.create']);
//        });
//
//
//    });
//});


