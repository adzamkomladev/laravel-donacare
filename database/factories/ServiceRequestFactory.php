<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ServiceRequest;
use Faker\Generator as Faker;

$factory->define(ServiceRequest::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(4),
        'status' => 'initiated',
        'hospital_name' => $faker->company,
        'hospital_contact' => $faker->e164PhoneNumber,
        'hospital_location' => $faker->city,
        'doctor_name' => $faker->name(),
        'doctor_contact' => $faker->e164PhoneNumber,
    ];
});
