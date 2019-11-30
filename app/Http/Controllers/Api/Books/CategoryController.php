<?php

namespace App\Http\Controllers\Api\Books;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Repositories\Books\CategoryRepository;
use App\Repositories\UserRepository;
use App\Services\OAuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends ApiController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @SWG\Get(
     *     path="/api/books/categories",
     *     summary="Категории для книг",
     *     tags={"Books"},
     *     @SWG\Response(
     *         response="default",
     *         description="Ошибка валидации",
     *         @SWG\Schema(
     *            @SWG\Property(
     *                property="data",
     *                type="object",
     *                ref="#/definitions/ErrorMessage"
     *            ),
     *         )
     *     )
     * )
     */
    /**
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        try{
            $categories = $this->categoryRepository->getAll();

            return $this->successJsonMessage($categories);

        } catch (\Exception $exception){
            return $this->errorJsonMessage($exception->getMessage());
        }
    }
}