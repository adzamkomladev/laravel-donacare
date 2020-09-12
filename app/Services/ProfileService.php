<?php

namespace App\Services;

use App\Profile;

class ProfileService
{

    /**
     * Create profile
     *
     * @return \App\Profile
     **/
    public function create(Profile $profile, array $requestData)
    {
        $profile = Profile::create($requestData);

        $profile->user()->update(['role' => $requestData['role']]);

        return $profile;
    }

    /**
     * Update profile
     *
     * @return \App\Profile
     **/
    public function update(Profile $profile, array $requestData)
    {
        $profile->update($requestData);

        return $profile;
    }

    /**
     * Update jurisdiction
     *
     * @return \App\Profile
     **/
    public function updateJurisdiction(Profile $profile, string $jurisdiction)
    {
        $profile->update(['jurisdiction' => $jurisdiction]);

        return $profile;
    }
}
