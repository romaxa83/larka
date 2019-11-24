<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'regex:/^[A-z0-9 -]*$/u', 'max:191'],
            'password' => 'required|string|min:5',
        ];
    }
}

/**
 * @SWG\Definition(
 *     definition="LoginRequest",
 *     type="object",
 *     @SWG\Property(property="login", type="string"),
 *     @SWG\Property(property="password", type="string"),
 * )
 */