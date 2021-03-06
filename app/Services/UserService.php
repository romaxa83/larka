<?php

namespace App\Services;

use App\Events\PrivateMessageEvent;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User as UserRequest;
use App\Models\User\Role;
use App\Models\User\User;
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
        $user->status = User::STATUS_DRAFT;
        $user->password = Hash::make($request['password']);

        $user->save();

        if(isset($request['roles'])){
            $user->attachRoles($request['roles']);
        } else {
            $user->setRole(Role::USER_ALIAS);
        }

        return $user;
    }

    public function createByAdmin(UserRequest\CreateRequest $request): User
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->status = User::STATUS_ACTIVE;
        $user->password = Hash::make($request['password']);

        $user->save();

        if(isset($request['roles'])){
            $user->attachRoles($request['roles']);
        } else {
            $user->setRole(Role::USER_ALIAS);
        }

        return $user;
    }

    public function editByAdmin(UserRequest\UpdateRequest $request, $id): User
    {
        $user = $this->userRepository->getUserById($id);

        $user->name = $request['name'];
        $user->email = $request['email'];

        if($request['phone'] != $user->phone){
            $user->unverifyPhone();
        }
        $user->phone = $request['phone'];

        if($request['password'] != null){
            $user->password = Hash::make($request['password']);
        }

        $user->save();
        $user->detachRoles();

        if(isset($request['roles'])){
            $user->attachRoles($request['roles']);
        } else {
            $user->setRole(Role::USER_ALIAS);
        }

        PrivateMessageEvent::dispatch([
            'channels' => 'pr.message.' . $user->id,
            'message' => 'you have a new role'
        ]);

        return $user;
    }

}