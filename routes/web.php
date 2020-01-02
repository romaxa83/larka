<?php

use App\Mail\TestMail;


Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::any('/admin', 'Auth\LoginController@login')->name('admin.login');

//Route::get('/testmail', function(){
//    $data = ['message' => 'fuckkkk'];
//    Mail::to('romaxa8383@gmail.com')->send(new TestMail($data));
//    return back();
//})->name('testmail');

Route::get('admin/chart/chart/line',['uses' => 'Admin\Chart\ChartController@line', 'as' => 'admin.chart.line']);
Route::get('admin/chart/chart/line-random',['uses' => 'Admin\Chart\ChartController@lineRandom', 'as' => 'admin.chart.line.random']);
Route::get('admin/chart/chart/pie',['uses' => 'Admin\Chart\ChartController@pie', 'as' => 'admin.chart.pie']);

Route::post('admin/chart/chart/line',['uses' => 'Admin\Chart\ChartController@line', 'as' => 'admin.chart.line']);

// маршруты для тестирования сокетов (laravel-echo)
Route::post('/echo-chat/messages',['uses' => 'Admin\Chat\ChatController@publicMessage', 'as' => 'echo.chat.message']);

Route::middleware('auth')->group(function () {

    Route::get('admin',['uses' => 'Admin\HomeController@index', 'as' => 'admin.home']);

    Route::get('admin/users',['uses' => 'Admin\UserController@index', 'as' => 'admin.users']);

    Route::get('admin/user/create',['uses' => 'Admin\UserController@create', 'as' => 'admin.user.create']);
    Route::post('admin/user/create',['uses' => 'Admin\UserController@store', 'as' => 'admin.user.create']);
    Route::get('admin/user/edit/{id}',['uses' => 'Admin\UserController@edit', 'as' => 'admin.user.edit']);
    Route::post('admin/user/edit/{id}',['uses' => 'Admin\UserController@update', 'as' => 'admin.user.update']);


    Route::get('admin/books/category',['uses' => 'Admin\Books\CategoryController@index', 'as' => 'admin.books.category']);
    Route::get('admin/books/category/create',['uses' => 'Admin\Books\CategoryController@create', 'as' => 'admin.books.category.create']);
    Route::post('admin/books/category/store',['uses' => 'Admin\Books\CategoryController@store', 'as' => 'admin.books.category.store']);

    Route::get('admin/socket-check',['uses' => 'Admin\HomeController@checkSocket', 'as' => 'admin.socket.check']);

    Route::get('admin/socket',['uses' => 'Admin\Socket\SocketController@index', 'as' => 'admin.socket']);
    Route::get('admin/socket-push',['uses' => 'Admin\Socket\SocketController@push', 'as' => 'admin.socket.push']);

});


