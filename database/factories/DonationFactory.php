<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Donation;
use Faker\Generator as Faker;

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(4),
        'status' => 'initiated',
        'value' => 'Liver',
        'cost' => $faker->randomFloat(2, 10, 999.99),
        'hospital_name' => $faker->company,
        'hospital_contact' => $faker->e164PhoneNumber,
        'hospital_location' => $faker->city,
        'doctor_name' => $faker->name(),
        'doctor_contact' => $faker->e164PhoneNumber,
    ];
});
