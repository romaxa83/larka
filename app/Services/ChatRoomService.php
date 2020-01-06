<?php

namespace App\Services;

use App\Models\User\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatRoomService
{


    public function create(Request $request)
    {
        $room = new ChatRoom();
        $room->name = $request['name'];
        $room->alias = Str::slug($room->name, '-');

        $room->save();

        if(isset($request['users'])){
            $room->attachUsers($request['users']);
        }

        return $room;
    }
}