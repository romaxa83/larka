<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class RegisterController extends ApiController
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @SWG\Post(
     *     path="/api/register",
     *     summary="Регистрация пользователя",
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/RegisterRequest")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success response",
     *     )
     * )
     */
    public function register(RegisterRequest $request)
    {

        $this->service->create($request);

        return $this->successJsonMessage('User Created');
    }
}