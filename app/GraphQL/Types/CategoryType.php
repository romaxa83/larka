<?php

namespace App\GraphQL\Types;

use App\Models\Books\Category;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Category of books',
        'model' => Category::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID for category'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title for category'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Slug of url'
            ],
            'parent_id' => [
                'type' => Type::int(),
                'description' => 'ID for parent category'
            ],
            'position' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Position category'
            ],
            'status' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Status for category'
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Create category'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last update category'
            ],
            'books' => [
                'type' => Type::listOf(GraphQL::type('book')),
                'description' => 'Books for this category'
            ],
        ];
    }
}