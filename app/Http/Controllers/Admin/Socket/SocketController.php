<?php

namespace App\Http\Controllers\Admin\Socket;

use App\Events\ChartRealTimeEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocketController extends Controller
{
    public function index()
    {
        return view('admin.socket.index');
    }
}