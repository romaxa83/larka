<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Exports\UserExportHeading;
use App\Exports\UserExportMapping;
use App\Exports\UserExportView;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\User;
use App\Import\UserImport;
use App\Models\Image;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    //------------------------------------------
    // Action for Export/Import
    //-----------------------------------------

    // экспорт данных из бд
    public function export()
    {
        return Excel::download(new UserExport(), 'users.xlsx');
    }

    // экспорт таблицу из шаблона
    public function exportView()
    {
        return Excel::download(new UserExportView(), 'users-view.xlsx');
    }

    // экспорт в локальное хранилище
    public function exportStore()
    {
        Excel::store(new UserExport(), 'users-' . time() . '.xlsx');

        return redirect()->route('admin.users')
            ->with('success', 'User export to local store');
    }

    // экспорт в определеный формат (pdf, scv, html)
    public function exportFormat($format)
    {
        $extension = strtolower($format);
        if(in_array($format, ['Mpdf', 'Dompdf', 'Tcpdf'])) $extension = 'pdf';

        return Excel::download(new UserExport(), 'users.' . $extension, $format);
    }

    // экспорт данных с заголовками
    public function exportHeading()
    {
        return Excel::download(new UserExportHeading(), 'users.xlsx');
    }

    // экспорт данных с mapping
    public function exportMapping()
    {
        return Excel::download(new UserExportMapping(), 'users.xlsx');
    }

    // импорт данных
    public function import(Request $request)
    {
        Excel::import(new UserImport(), $request->file('import'), null, 'Xlsx');

        // если нужно загрузить файл другог типа (csv, ...)
        // указываем так
//        Excel::import(new UserImport(), $request->file('import'), null, 'Csv');

        return redirect()->route('admin.users')
            ->with('success', 'Successfully imported.');
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