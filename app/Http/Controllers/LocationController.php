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

        return Location::updateOrCreate(['user_id' => $requestData['user_id']], $requestData);
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
