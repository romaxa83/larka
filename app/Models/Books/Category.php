<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Books\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int|null $parent_id
 * @property int position
 * @property int status
 * @property string $created_at
 * @property string $updated_at
 */

class Category extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'books_category';

    // relation

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
