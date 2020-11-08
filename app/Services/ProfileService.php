<?php

namespace App\Services;

use App\Donation;
use App\Notifications\DonationRequested;
use App\Profile;
use App\User;

class ProfileService
{
    /**
     * Create profile
     *
     * @return \App\Profile
     **/
    public function create(User $user, array $requestData)
    {
        $user->profile()->create($requestData);

        if ($requestData['role']) {
            $user->update(['role' => $requestData['role']]);
        }

        if ($user->role === 'donor') {
            Donation::isAvailable()
                ->isNotExpired()
                ->canMakeDonation($user->profile->blood_group)
                ->get()
                ->each(function ($donation) use ($user) {
                    $user->notify(new DonationRequested($donation));
                });
        }

        return $user->profile;
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
