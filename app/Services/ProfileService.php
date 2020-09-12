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
    public function create(array $requestData)
    {
        $stepOne = $this->getStepOneData();
        $profileData = collect($requestData)->merge($stepOne)->all();

        $profile = Profile::create($profileData);

        $profile->user()->update(['role' => $profileData['role']]);

        session()->forget('step_one');

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

    /**
     * Save data from step one of profile creation form
     *
     **/
    public function saveStepOneData($validatedData)
    {
        session(['step_one' => $validatedData]);
    }

    /**
     * Retrieve data from step one of profile creation form
     *
     * @return array
     **/
    public function getStepOneData()
    {
        return session('step_one');
    }
}
