<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    //relation
    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'users_role_pivot', 'user_id', 'role_id');
    }

    public function setRole(string $role)
    {
        $role = UserRole::where(['alias' => $role])->first();
        $this->roles()->attach($role->id);
    }

    public function getRolesString()
    {
        return $this->roles()->pluck('role')->implode(',');
    }

}
