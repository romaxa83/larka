<?php

namespace App\Http\Controllers\Admin\Chat;

use App\Events\EchoChatEvent;
use App\Http\Controllers\Controller;
use App\Models\User\ChatRoom;
use App\Repositories\UserRepository;
use App\Services\ChatRoomService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ChatRoomService
     */
    private $chatRoomService;

    public function __construct(UserRepository $userRepository, ChatRoomService $chatRoomService)
    {
        $this->userRepository = $userRepository;
        $this->chatRoomService = $chatRoomService;
    }

    public function index()
    {
        $rooms = ChatRoom::query()->with(['users'])->get();

        return view('admin.chat-room.index', compact('rooms'));
    }

    public function create()
    {
        $users = $this->userRepository->getAll();

        return view('admin.chat-room.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $this->chatRoomService->create($request);
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->route('admin.chat-rooms')
            ->with('success', 'Private Chat room create');
    }

    public function room(ChatRoom $room)
    {
        return view('room', ['room' => $room]);
    }

    public function getRoom(ChatRoom $room)
    {
        return $room;
    }


    public function publicMessage(Request $request)
    {
        // передаем в событие данные
        EchoChatEvent::dispatch($request->input('body'));
    }


}