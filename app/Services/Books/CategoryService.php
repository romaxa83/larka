<?php

namespace App\Services\Books;

use App\Http\Requests\Books\CategoryCreateRequest;
use App\Models\Books\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function create(CategoryCreateRequest $request): ?Category
    {
        $category = new Category();
        $category->title = $request->input('title');
        $category->slug = Str::slug($category->title, '-');
        $category->position = $request->input('position');
        $category->status = Category::STATUS_ACTIVE;

        if(!$category->save()){
            throw new \Exception('Категория не сохраненеа');
        }

        return $category;
    }
}