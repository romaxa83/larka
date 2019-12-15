<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'regex:/^[А-яA-z0-9 -]*$/u', 'max:191'],
            'position' => 'required|numeric',
            'parent_id' => 'nullable|numeric'
        ];
    }
}