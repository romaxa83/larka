<?php

namespace App\Http\Controllers\Admin\Socket;

use App\Events\ChartRealTimeEvent;
use App\Http\Controllers\Controller;
use App\Socket\PusherSocket;
use Illuminate\Http\Request;

class SocketController extends Controller
{
    public function index()
    {
        return view('admin.socket.index');
    }

    public function push()
    {
        $localsocket = 'tcp://192.168.126.102:1234';
        $user = 'tester01';
        $message = 'test';

        // соединяемся с локальным tcp-сервером
        $instance = stream_socket_client($localsocket);
//        stream_set_blocking($instance,1);
//        dd(fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n"));
        // отправляем сообщение
        fwrite($instance, json_encode(['user' => $user, 'message' => $message])  . "\n");

        return view('admin.socket.push');
    }
}