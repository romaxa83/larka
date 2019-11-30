<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Books\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->city,
        'slug' => Str::slug($title, '-'),
        'parent_id' => null,
        'position' => random_int(1,10),
        'status' => Category::STATUS_ACTIVE,
    ];
});