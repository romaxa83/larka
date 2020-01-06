<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        UserRepository $userRepository,
        UserService $userService,
        RoleRepository $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->getRolesForSelect();

        return view('admin.user.create', compact('roles'));
    }

    public function store(User\CreateRequest $request)
    {
        try {
            $this->userService->createByAdmin($request);
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->route('admin.users')
            ->with('success', 'User create');
    }

    public function edit($id)
    {
        $user = $this->userRepository->getUserById($id);
        $roles = $this->roleRepository->getRolesForSelect();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(User\UpdateRequest $request, $id)
    {
        try {
            $this->userService->editByAdmin($request, $id);
        } catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->route('admin.users')
            ->with('success', 'User update');
    }

    // контроллер для получение авторизованого пользователя
    // для работы с приватными сообшениями через сокеты
    public function getAuthUser()
    {
        if($user = Auth::user()){

            return response()->json([
                'data' => $user,
                'success' => true
            ],200);
        };

        return response()->json([
            'data' => [],
            'success' => false
        ], 200);
    }
}