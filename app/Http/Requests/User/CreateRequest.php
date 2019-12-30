<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[A-z0-9 -]*$/u', 'max:191', Rule::unique('users','name')],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password' => 'required|string|min:5',
            'roles' => 'array'
        ];
    }
}