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

    // прописываем принимаемык аргументы
    public function args(): array
    {
       return [
           'categoryId' => ['type' => Type::int()]
       ];
    }

    public function type(): Type
    {
        //тип прописан в конфиге
        return Type::listOf(GraphQL::type('category'));
    }

    public function resolve($root, $args)
    {
        if(isset($args['categoryId'])){
            return Category::where('id', $args['categoryId'])->get();
        }

        return Category::all();
    }
}