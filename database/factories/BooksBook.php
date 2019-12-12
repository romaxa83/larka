<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Books\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->city,
        'slug' => Str::slug($title, '-'),
        'description' => $faker->sentence(18),
        'lang' => $faker->languageCode,
        'pages' => random_int(250, 500),
        'amount' => random_int(250, 500),
        'amount_current' => random_int(250, 500),
        'count_read' => random_int(50, 150),
        'published_date' => Carbon\Carbon::now(),
    ];
});