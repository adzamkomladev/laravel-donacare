<?php

use App\Location;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' => 'Kaneshie Polyclinic',
            'address' => 'Palace St, Accra',
            'lat' => 5.5746047,
            'lng' => -0.2314314
        ])->hospital()->create([
            'activated' => true
        ]);

        Location::create([
            'name' => 'Korle Bu Hospital',
            'address' => 'Guggisberg Ave, Korlebu',
            'lat' => 5.5366123,
            'lng' => -0.2285978
        ])->hospital()->create([
            'activated' => true
        ]);

        Location::create([
            'name' => 'Komfo Anokye Hospital',
            'address' => 'Okomfo Anokye Road, Kumasi',
            'lat' => 6.697432,
            'lng' => -1.633873
        ])->hospital()->create([
            'activated' => true
        ]);
    }
}
