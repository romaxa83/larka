<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Books\Author;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->city,
        'slug' => Str::slug($title, '-'),
        'country' => $faker->country
    ];
});