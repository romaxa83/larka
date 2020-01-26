<?php

namespace App\Models\User;

use App\Models\Image;
use App\Traits\Roleable;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 * @property string $phone_verify_token
 * @property Carbon $phone_verify_token_expire
 * @property Carbon $email_verified_at
 * @property int $status
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
*/

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
        'name', 'email', 'password', 'phone'
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
        'phone_verified' => 'boolean',
        'phone_verify_token_expire' => 'datetime',
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

    public function getAvatarAttribute()
    {
        return $this->image ? $this->image->getPath() : null;
    }

    //------------------------------------------------------
    // Verify Phone

    /**
     * @throws \Throwable
     */
    public function unverifyPhone(): void
    {
        $this->phone_verified = false;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    /**
     * @param Carbon $now
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function requestPhoneVerification(Carbon $now): string
    {
        if(empty($this->phone)){
            throw new \Exception('Phone number is empty.');
        }

        if(!empty($this->phone_verify_token) && $this->phone_verify_token_expire && $this->phone_verify_token_expire->gt($now)){
            throw new \Exception('Token is already requested.');
        }

        $this->phone_verified = false;
        $this->phone_verify_token = (string)random_int(10000,99999);
        $this->phone_verify_token_expire = $now->copy()->addSeconds(300);
        $this->saveOrFail();

        return $this->phone_verify_token;
    }

    /**
     * @param $token
     * @param Carbon $now
     * @throws \Exception
     * @throws \Throwable
     */
    public function verifyPhone($token, Carbon $now): void
    {
        if($token !== $this->phone_verify_token){
            throw new \Exception('Incorrect verify token.');
        }

        if($this->phone_verify_token_expire->lt($now)){
            throw new \Exception('Token is expired.');
        }

        $this->phone_verified = true;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    public function isPhoneVerified(): bool
    {
        return $this->phone_verified;
    }

    //-------------------------------------------------
}
