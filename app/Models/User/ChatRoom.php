<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatRoom
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 */

// модели для закрытых комнат приватного чата
class ChatRoom extends Model
{
    protected $table = 'chat_rooms';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany( User::class);
    }

    public function attachUsers(array $usersId)
    {
        $this->users()->attach($usersId);
    }
}
