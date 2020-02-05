<?php

namespace App\Http\Controllers\Admin\Socket;

use App\Events\PrivateNodeMessageEvent;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class NodeRedisController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $user = \Auth::user();
        $users = $this->userRepository->getUsersForSelect($user->id);

        return view('admin.socket.node-redis.index', compact('user', 'users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function push(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'users' => 'array'
        ]);


        PrivateNodeMessageEvent::dispatch([
            'channels' => 'user.' . $request->users[0],
            'message' => $request->message
        ]);

        return redirect()->route('admin.socket.node-redis');
    }
}