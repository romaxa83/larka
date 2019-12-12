<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Books\Publisher
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $country
 * @property string $city
 * @property string $created_at
 * @property string $updated_at
 */

class Publisher extends Model
{
    protected $table = 'books_publisher';

}