<?php

namespace App\Services;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function create(RegisterRequest $request)
    {

        $user = new User();
        $user->name = $request['login'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);

        $user->save();
    }

}