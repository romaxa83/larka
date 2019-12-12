<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Books\Publisher;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Publisher::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->city,
        'slug' => Str::slug($name, '-'),
        'country' => $faker->country,
        'city' => $faker->city
    ];
});