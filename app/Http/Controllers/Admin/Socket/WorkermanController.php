<?php

namespace App\Http\Controllers\Admin\Socket;

use App\Http\Controllers\Controller;

class WorkermanController extends Controller
{
    public function index()
    {
        $user = \Auth::user();

        return view('admin.socket.workerman.index', compact('user'));
    }

    public function push()
    {
        $localsocket = 'tcp://192.168.126.102:1234';
        $user = '16';
        $message = 'test';

        // соединяемся с локальным tcp-сервером
        $instance = stream_socket_client($localsocket);

        fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n");

        return redirect()->route('admin.socket.workerman');
    }
}