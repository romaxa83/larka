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
Route::post('/private-chat/messages',['uses' => 'Admin\Chat\ChatController@privateMessage', 'as' => 'echo.private.chat.message']);

Route::get('/room/{room}',['uses' => 'Admin\Chat\ChatController@room', 'as' => 'room.chat']);
Route::post('/room/{room}',['uses' => 'Admin\Chat\ChatController@getRoom', 'as' => 'room.chat']);

Route::get('/private-message',['uses' => 'Admin\Chat\ChatController@privateMessage', 'as' => 'private.chat.message']);
Route::post('/get-auth-user',['uses' => 'Admin\UserController@getAuthUser', 'as' => 'auth.user']);

Route::middleware('auth')->group(function () {

    Route::get('admin',['uses' => 'Admin\HomeController@index', 'as' => 'admin.home']);

    /* route for User */
    Route::get('admin/users',['uses' => 'Admin\UserController@index', 'as' => 'admin.users']);
    Route::get('admin/user/create',['uses' => 'Admin\UserController@create', 'as' => 'admin.user.create']);
    /* route for User (export)*/
    Route::get('admin/user/export',['uses' => 'Admin\UserController@export', 'as' => 'admin.user.export']);
    Route::get('admin/user/export-view',['uses' => 'Admin\UserController@exportView', 'as' => 'admin.user.export-view']);
    Route::get('admin/user/export-store',['uses' => 'Admin\UserController@exportStore', 'as' => 'admin.user.export-store']);
    Route::get('admin/user/export-format/{format}',['uses' => 'Admin\UserController@exportFormat', 'as' => 'admin.user.export-format']);
    Route::get('admin/user/export-heading',['uses' => 'Admin\UserController@exportHeading', 'as' => 'admin.user.export-heading']);
    Route::get('admin/user/export-mapping',['uses' => 'Admin\UserController@exportMapping', 'as' => 'admin.user.export-mapping']);
    /* route for User (import)*/
    Route::post('admin/user/import',['uses' => 'Admin\UserController@import', 'as' => 'admin.user.import']);
    Route::post('admin/user/import-csv',['uses' => 'Admin\UserController@importCsv', 'as' => 'admin.user.import.csv']);

    Route::post('admin/user/create',['uses' => 'Admin\UserController@store', 'as' => 'admin.user.create']);
    Route::get('admin/user/edit/{id}',['uses' => 'Admin\UserController@edit', 'as' => 'admin.user.edit']);
    Route::post('admin/user/edit/{id}',['uses' => 'Admin\UserController@update', 'as' => 'admin.user.update']);

    Route::post('admin/user/upload',['uses' => 'Admin\UserController@upload', 'as' => 'admin.user.upload']);

    Route::get('admin/user/phone', ['uses' => 'Admin\PhoneController@form', 'as' => 'admin.user.phone']);
    Route::post('admin/user/phone', 'Admin\PhoneController@request');
    Route::post('admin/user/phone-verify', 'Admin\PhoneController@verify')
        ->name('admin.user.phone.verify');

    Route::get('admin/user/{id}',['uses' => 'Admin\UserController@show', 'as' => 'admin.user']);

    /* route for Chat */
    Route::get('admin/chat-rooms',['uses' => 'Admin\Chat\ChatController@index', 'as' => 'admin.chat-rooms']);
    Route::get('admin/chat-room/create',['uses' => 'Admin\Chat\ChatController@create', 'as' => 'admin.chat-room.create']);
    Route::post('admin/chat-room/create',['uses' => 'Admin\Chat\ChatController@store', 'as' => 'admin.chat-room.create']);

    /* route for Socket (Workerman)*/
    Route::get('admin/socket/workerman',['uses' => 'Admin\Socket\WorkermanController@index', 'as' => 'admin.socket.workerman']);
    Route::get('admin/socket/workerman/push',['uses' => 'Admin\Socket\WorkermanController@push', 'as' => 'admin.socket.workerman.push']);

    /* route for Socket (Node + Redis)*/
    Route::get('admin/socket/node-redis',['uses' => 'Admin\Socket\NodeRedisController@index', 'as' => 'admin.socket.node-redis']);
    Route::post('admin/socket/node-redis/push',['uses' => 'Admin\Socket\NodeRedisController@push', 'as' => 'admin.socket.node-redis.push']);

    /* route for Dropbox */
    Route::get('admin/dropbox',['uses' => 'Admin\DropboxController@index', 'as' => 'admin.dropbox']);

    /* route for Articles */
    Route::get('admin/articles/demiart',['uses' => 'Admin\Blogs\ArticleController@demiart', 'as' => 'admin.articles.demiart']);

    /* route for Jobs (testing) */
    Route::get('admin/jobs',['uses' => 'Admin\JobsController@run', 'as' => 'admin.jobs.run']);

    Route::get('admin/books/category',['uses' => 'Admin\Books\CategoryController@index', 'as' => 'admin.books.category']);
    Route::get('admin/books/category/create',['uses' => 'Admin\Books\CategoryController@create', 'as' => 'admin.books.category.create']);
    Route::post('admin/books/category/store',['uses' => 'Admin\Books\CategoryController@store', 'as' => 'admin.books.category.store']);

    Route::get('admin/socket-check',['uses' => 'Admin\HomeController@checkSocket', 'as' => 'admin.socket.check']);
});


