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
        return User::query()->with(['roles'])->get();
    }
//
//    public function getUsersForAdminPanel($limit = User::DEFAULT_LIMIT, $offset = User::DEFAULT_PAGE)
//    {
//        if($offset){
//            $offset = $limit*$offset;
//        }
//
//        return DB::table('users as u')
//            ->join('user_profile as p', 'u.id', '=','p.user_id')
//            ->select('u.*','p.*')
//            ->where([
//                ['u.email', '!=','NULL'],
//                ['u.email', '!=',User::ADMIN_EMAIL]
//            ])->limit($limit)->offset($offset)
//            ->get();
//    }
//
//    public function getUsersCountForAdminPanel()
//    {
//        return DB::table('users as u')
//            ->join('user_profile as p', 'u.id', '=','p.user_id')
//            ->select('u.*','p.*')
//            ->where([
//                ['u.email', '!=','NULL'],
//                ['u.email', '!=',User::ADMIN_EMAIL]
//            ])
//            ->count();
//    }
}