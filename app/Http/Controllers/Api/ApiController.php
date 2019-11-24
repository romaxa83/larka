<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * @SWG\Swagger(
 *   schemes={"http"},
 *   host="",
 *   basePath="",
 *   @SWG\Info(
 *     title="Larka API",
 *     version="1.0.0",
 *   )
 * )
 * @SWG\Definition(
 *     definition="SuccessMessage",
 *     @SWG\Property(
 *         property="success",
 *         type="boolean",
 *         example = true
 *     ),
 *     @SWG\Property(
 *         property="data",
 *         type="string",
 *         example = "Сообщение"
 *     )
 * )
 * @SWG\Definition(
 *     definition="SuccessData",
 *     @SWG\Property(
 *         property="success",
 *         type="boolean",
 *         example = true
 *     ),
 *     @SWG\Property(
 *         property="data",
 *         type="string",
 *         example = "данные"
 *     )
 * )
 * @SWG\Definition(
 *     definition="ErrorMessage",
 *     @SWG\Property(
 *         property="success",
 *         type="boolean",
 *         example = false
 *     ),
 *     @SWG\Property(
 *         property="data",
 *         type="string",
 *         example = "Сообщение об ошибке"
 *     )
 * )
 *@SWG\Parameter(
 *         parameter="Auth-Refresh",
 *         name="body",
 *         in="body",
 *         required=true,
 *         @SWG\Schema(
 *             type="object",
 *             @SWG\Property(
 *                 property="refresh_token",
 *                 type="string",
 *                 description="Текущий пароль",
 *             )
 *         )
 *     )
 * @SWG\Parameter(
 *         parameter="Auth",
 *         name="authorization",
 *         in="header",
 *         type="string",
 *         required=true,
 *         description="Токен",
 *         default="Bearer "
 *     ),
 */
class ApiController extends Controller
{
    protected function successJsonMessage($message, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $message,
            'success' => true
        ], $code);
    }

    protected function errorJsonMessage($message, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $message,
            'success' => false
        ], $code);
    }
}