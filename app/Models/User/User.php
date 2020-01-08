<?php

namespace App\Models\User;

use App\Models\Image;
use App\Traits\Roleable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Roleable;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BAN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relation for chat-room
    public function rooms()
    {
        return $this->belongsToMany( ChatRoom::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
