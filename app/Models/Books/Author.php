<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Books\Author
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $country
 * @property string $created_at
 * @property string $updated_at
 */

class Author extends Model
{
    protected $table = 'books_author';
}