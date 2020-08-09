<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);

    return [
        'first_name' => $faker->firstName($gender),
        'last_name' => $faker->lastName,
        'other_names' => $faker->firstName($gender),
        'gender' => $gender
    ];
});
