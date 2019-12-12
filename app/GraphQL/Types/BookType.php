<?php

namespace App\GraphQL\Types;

use App\Models\Books\Book;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Book',
        'description' => 'Book',
        'model' => Book::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID for book'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title for book'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Slug of url'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description for book'
            ],
            'lang' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Book\'s language'
            ],
            'rating' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Book\'s rating'
            ],
            'pages' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Count page is this book'
            ],
            'amount' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'All count books'
            ],
            'amount_current' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Count books now'
            ],
            'count_read' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Count read this book'
            ],
//            'category' => [
//                'type' => Type::nonNull(GraphQL::type('category')),
//                'description' => 'Category this book'
//            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Create category'
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last update category'
            ],
        ];
    }
}