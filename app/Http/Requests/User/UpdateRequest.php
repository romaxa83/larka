<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'regex:/^[A-z0-9 -]*$/u', 'max:191', Rule::unique('users','name')->ignore($this->getUserId())],
            'email' => ['string', 'email', 'max:191', Rule::unique('users', 'email')->ignore($this->getUserId())],
            'password' => 'nullable|string|min:5',
            'roles' => 'array'
        ];
    }

    private function getUserId()
    {
        $arr = explode('/', $this->decodedPath());
        return end($arr);
    }
}