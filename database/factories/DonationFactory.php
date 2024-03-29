<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Donation;
use Faker\Generator as Faker;

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'status' => 'initiated',
        'type' => $faker->randomElement([
            'blood', 'organ', 'funds'
        ]),
        'value' => $faker->randomElement([
            'O+', 'A+', 'O-', 'A-', 'AB+', 'AB-', 'B+', 'B-'
        ]),
        'value_type' => $faker->randomElement([
            'Whole blood donation', 'Plasma donation', 'Power red donation', 'Platelet donation'
        ]),
        'description' => $faker->paragraph(4),
        'date_needed' => now(),
        'cost' => 2800,
        'payment_status' => $faker->randomElement([
            'free', 'charged'
        ]),
        'payment_method' => $faker->randomElement([
            'Mobile money', 'Cash', 'Credit/Debit card'
        ]),
        'hospital_id' => $faker->randomElement([1, 2, 3]),
        'share_location' => $faker->boolean,
        'quantity' => $faker->randomElement([
            1, 2, 3, 4
        ]),
    ];
});
