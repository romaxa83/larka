<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Books\Book
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $lang
 * @property int $pages
 * @property int $amount
 * @property int $amount_current
 * @property int $rating
 * @property int $count_read
 * @property int $category_id
 * @property int $author_id
 * @property int $image_id
 * @property int $publisher_id
 * @property string $publisher_date
 * @property string $created_at
 * @property string $updated_at
 */

class Book extends Model
{
    protected $table = 'books_book';

    // relation

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}