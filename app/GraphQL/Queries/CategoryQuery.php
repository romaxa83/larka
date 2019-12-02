<?php

namespace App\GraphQL\Queries;

use App\Models\Books\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'The category query',
        'description' => 'Category query'
    ];

    public function type(): Type
    {
        //тип прописан в конфиге
        return Type::listOf(GraphQL::type('category'));
    }

    public function resolve($root, $args)
    {
        return Category::all();
    }
}