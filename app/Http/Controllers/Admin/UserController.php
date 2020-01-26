<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\User;
use App\Models\Image;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $title = 'Users';
        $users = $this->userRepository->getAll();

        return view('admin.user.index', compact('users', 'title'));
    }

    public function create()
    {
        $title = 'Create user';
        $roles = $this->roleRepository->getRolesForSelect();

        return view('admin.user.create', compact('roles', 'title'));
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
        $title = "Edit user by {$user->name}";
        $roles = $this->roleRepository->getRolesForSelect();

        return view('admin.user.edit', compact('user', 'roles', 'title'));
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

    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);
        $title = "Show user by {$user->name}";

        return view('admin.user.show', compact('user', 'title'));
    }

    public function upload(UploadRequest $request)
    {
        $url = $request->file('image')
            ->store('uploads', 'public');


        if($img = Image::where('user_id', '=', $request['user_id'])->first()){

            $f = Storage::disk('public');
            $f->delete($img->url);

            $img->url = $url;
            $img->base_name = $url;
            $img->save();

        } else {

            $image = new Image();
            $image->user_id = $request['user_id'];
            $image->url = $url;
            $image->base_name = $url;
            $image->save();
        }


        return redirect()->route('admin.user',['id' => $request['user_id']]);
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