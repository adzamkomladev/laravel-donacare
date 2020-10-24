<?php

use App\User;
use App\Service;
use App\Donation;
use App\Hospital;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = User::ofRole('patient')->get();

        $services = Service::all();
        $hospitals = Hospital::all();

        factory(Donation::class, 6)->create()->each(function ($donation) use ($patients, $services, $hospitals) {
            [$service] = $services->random(1)->all();
            $donation->service()->associate($service);
            $donation->save();

            [$patient] = $patients->random(1)->all();
            $donation->patient()->associate($patient);
            $donation->save();

            [$hospital] = $hospitals->random(1)->all();
            $donation->hospital()->associate($hospital);
            $donation->save();
        });
    }
}
