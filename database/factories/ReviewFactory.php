<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'rating' => $faker->randomElement([1,2,3,4,5]),
        'details' => $faker->paragraph()
    ];
});
