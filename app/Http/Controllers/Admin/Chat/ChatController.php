<?php

namespace App\Http\Controllers\Admin\Chat;

use App\Events\EchoChatEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function publicMessage(Request $request)
    {
        // передаем в событие данные
        EchoChatEvent::dispatch($request->input('body'));
    }


}