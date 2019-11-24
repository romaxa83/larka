<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'regex:/^[A-z0-9 -]*$/u', 'max:191', Rule::unique('users','name')],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password' => 'required|string|min:5|confirmed',
        ];
     }
}

/**
 * @SWG\Definition(
 *     definition="RegisterRequest",
 *     type="object",
 *     @SWG\Property(property="login", type="string"),
 *     @SWG\Property(property="email", type="string"),
 *     @SWG\Property(property="password", type="string"),
 *     @SWG\Property(property="password_confirmation", type="string"),
 * )
 */