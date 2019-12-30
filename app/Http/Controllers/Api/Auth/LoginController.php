<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\User\User;
use App\Repositories\UserRepository;
use App\Services\OAuthService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends ApiController
{
    use AuthenticatesUsers;


    /**
     * @var OAuthService
     */
    private $authService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(OAuthService $authService, UserRepository $userRepository)
    {

        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    /**
     * @SWG\Post(
     *     path="/api/login",
     *     summary="Авторизация",
     *     tags={"User"},
     *      @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/LoginRequest")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Успешное авторизовано",
     *         @SWG\Schema(
     *            @SWG\Property(
     *                property="data",
     *                type="object",
     *                @SWG\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example = false
     *                 ),
     *                @SWG\Property(
     *                    property="token_type",
     *                    type="string",
     *                    example="Bearer"
     *                ),
     *                @SWG\Property(
     *                    property="expires_in",
     *                    type="integer",
     *                    example="31622399"
     *                ),
     *                @SWG\Property(
     *                    property="access_token",
     *                    type="string",
     *                    example="yJ0eXAiOiJKV1QiLCJhbGci"
     *                ),
     *                @SWG\Property(
     *                    property="refresh_token",
     *                    type="string",
     *                    example="yJ0eXAiOiJKV1QiLCJhbGci"
     *                ),
     *            ),
     *         )
     *     ),
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
    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        /** @var  $user User */
        $user = $this->userRepository->getUserByLogin($login);
        if(!$user){
            return $this->errorJsonMessage('Неверный логин');
        }

        if(!password_verify($password, $user->password)){
            return $this->errorJsonMessage('Неверный пароль');
        }

        $auth = $this->authService->getBearerToken($password, $user->email);

        if (isset($auth['error'])) {
            return $this->errorJsonMessage('Ошибка получение токена');
        }

        Auth::login($user);

        return $this->successJsonMessage($auth);
    }

    /**
     * @SWG\Post(
     *     path="/api/refresh-token",
     *     summary="Refresh user token",
     *     tags={"User"},
     *     @SWG\Parameter(
     *         ref="#/parameters/Auth-Refresh"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Успешное",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                property="data",
     *                type="object",
     *                @SWG\Property(
     *                    property="token_type",
     *                    type="string",
     *                    example="Bearer"
     *                ),
     *                @SWG\Property(
     *                    property="expires_in",
     *                    type="integer",
     *                    example="31622399"
     *                ),
     *                @SWG\Property(
     *                    property="access_token",
     *                    type="string",
     *                    example="yJ0eXAiOiJKV1QiLCJhbGci"
     *                ),
     *                @SWG\Property(
     *                    property="refresh_token",
     *                    type="string",
     *                    example="yJ0eXAiOiJKV1QiLCJhbGci"
     *                ),
     *            ),
     *         )
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ошибка",
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
     */
    public function refreshToken(Request $request)
    {
        $refreshToken = $this->authService->getRefreshToken($request->input('refresh_token'));

        if (!is_array($refreshToken)) {
            return $this->errorJsonMessage($refreshToken);
        }
        if (isset($refreshToken['error'])) {
            return $this->errorJsonMessage($refreshToken);
        }
        return $this->successJsonMessage($refreshToken);
    }

    /**
     * @SWG\Get(
     *     path="/api/logout",
     *     summary="Выход",
     *     tags={"User"},
     *     security={
     *          {"passport": {}},
     *     },
     *     @SWG\Parameter(
     *         ref="#/parameters/Auth"
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Успешное",
     *         @SWG\Schema(
     *            @SWG\Property(
     *                property="data",
     *                type="object",
     *                ref="#/definitions/SuccessMessage"
     *            ),
     *         )
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Ошибка",
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
    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return $this->errorJsonMessage('Пользователь не найден',404);
        }

        $token = $user->token();
        if ($token) {
            $token->revoke();
        }

        return $this->successJsonMessage('Пользователь разлогини');
    }




}