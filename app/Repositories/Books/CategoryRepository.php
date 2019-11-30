<?php

namespace App\Repositories\Books;

use App\Models\Books\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }
}