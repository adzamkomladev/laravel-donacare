<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $user = User::findOrFail($requestData['user_id']);

        if ($user->location) {
            $user->location()->update([
                'lng' => $requestData['lng'],
                'lat' => $requestData['lat'],
            ]);
            return $user->location;
        }

        $location = Location::create([
            'lng' => $requestData['lng'],
            'lat' => $requestData['lat'],
        ]);

        $user->location_id = $location->id;
        $user->save();

        return $user->location;
    }

    /**
     * Return user location
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user->location;
    }
}
