<?php

namespace App\Repositories;

use App\Models\User\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public function getUserById($userId) : User
    {
        return User::query()->with(['roles', 'image'])->where('id',$userId)->firstOrFail();
    }

    public function getEmailByLogin($login)
    {
        return User::where('name',$login)->pluck('email')->first();
    }

    public function getUserByLogin($login)
    {
        return User::where('name',$login)->first();
    }

    public function getAll()
    {
        return User::query()->notAdmin()->with(['roles'])->get();
    }

    public function getUsersForSelect($id)
    {
        return User::query()->pluck('name', 'id')->except($id);
    }
}