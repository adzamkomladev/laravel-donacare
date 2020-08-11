<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(6),
        'price' => $faker->randomFloat(2, 10, 99999.99),
        'available' => $faker->boolean
    ];
});
