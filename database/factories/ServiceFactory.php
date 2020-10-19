<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['blood', 'organ', 'funds']),
        'description' => $faker->paragraph(6),
        'price' => 2000,
        'available' => $faker->boolean
    ];
});
