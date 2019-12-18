<?php

namespace App\Http\Controllers\Admin\Books;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\CategoryCreateRequest;
use App\Jobs\BooksCategoryAfterCreateJob;
use App\Mail\TestMail;
use App\Repositories\Books\CategoryRepository;
use App\Services\Books\CategoryService;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryService $categoryService
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('admin.books.category.index', compact('categories'));
    }

    public function create()
    {
        //тестовая отправка писем
//        $data = ([
//            'name' => 'demo',
//            'email' =>  'romaxa8383@gmail.com',
//            'message' => 'demo'
//        ]);
//
//        Mail::to($data['email'])->send(new TestMail($data));

        return view('admin.books.category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        try {

            $category = $this->categoryService->create($request);

            $job = new BooksCategoryAfterCreateJob($category);
            $this->dispatch($job);

        } catch (\Exception $exception){

        }

        return redirect()->route('admin.books.category');
    }
}