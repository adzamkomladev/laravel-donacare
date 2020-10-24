<?php

namespace App\Services;

use App\Hospital;
use App\Location;

class HospitalService
{
    /**
     * Paginated complaints in the database.
     *
     * @return \App\Hospital[]
     **/
    public function findAll()
    {
        return Hospital::all();
    }

    /**
     * Create a new complaint
     *
     * @return \App\Hospital
     **/
    public function create(array $complaintData)
    {
        return Location::create([
            'name' => $complaintData['location_name'],
            'address' => $complaintData['location_address'],
            'lng' => $complaintData['lng'],
            'lat' => $complaintData['lat'],
        ])->hospital()
            ->create([
                'activated' => true
            ])->load('location');
    }
}
