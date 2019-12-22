<?php

use App\Mail\TestMail;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/testmail', function(){
//    $data = ['message' => 'fuckkkk'];
//    Mail::to('romaxa8383@gmail.com')->send(new TestMail($data));
//    return back();
//})->name('testmail');

Route::get('admin/chart/chart/line',['uses' => 'Admin\Chart\ChartController@line', 'as' => 'admin.chart.line']);
Route::get('admin/chart/chart/line-random',['uses' => 'Admin\Chart\ChartController@lineRandom', 'as' => 'admin.chart.line.random']);
Route::get('admin/chart/chart/pie',['uses' => 'Admin\Chart\ChartController@pie', 'as' => 'admin.chart.pie']);

Route::middleware('auth')->group(function () {

    Route::get('admin',['uses' => 'Admin\HomeController@index', 'as' => 'admin.home']);
    Route::get('admin/books/category',['uses' => 'Admin\Books\CategoryController@index', 'as' => 'admin.books.category']);
    Route::get('admin/books/category/create',['uses' => 'Admin\Books\CategoryController@create', 'as' => 'admin.books.category.create']);
    Route::post('admin/books/category/store',['uses' => 'Admin\Books\CategoryController@store', 'as' => 'admin.books.category.store']);

    Route::get('admin/socket',['uses' => 'Admin\Socket\SocketController@index', 'as' => 'admin.socket']);

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


