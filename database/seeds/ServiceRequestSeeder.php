<?php

use App\User;
use App\Service;
use App\ServiceRequest;
use Illuminate\Database\Seeder;

class ServiceRequestSeeder extends Seeder
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

        factory(ServiceRequest::class, 6)->create()->each(function ($serviceRequest) use ($patients, $services) {
            [$service] = $services->random(1)->all();
            $serviceRequest->service()->associate($service);
            $serviceRequest->save();

            [$patient] = $patients->random(1)->all();
            $serviceRequest->patient()->associate($patient);
            $serviceRequest->save();
        });
    }
}
