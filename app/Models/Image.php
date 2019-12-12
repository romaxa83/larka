<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $base_name
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 */


class Image extends Model
{
    protected $table = 'image';
}
