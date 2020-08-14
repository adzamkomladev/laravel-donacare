<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'lat' => $faker->randomElement([
            5.550000,
            5.666667,
            5.566667,
            5.600000,
            5.510000,
        ]),
        'lng' => $faker->randomElement([
            -0.020000,
            0.000000,
            0.030000,
            0.000430,
            -0.016543
        ]),
    ];
});
