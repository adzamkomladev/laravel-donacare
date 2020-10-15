<?php

namespace App\Services;

use App\Donation;
use App\User;

class NotificationService
{
    /**
     * Retrieve all unread notifications of a donor
     *
     * @return collection
     **/
    public function findAllUnreadByUser(User $user)
    {
        return $user->unreadNotifications->filter(function ($notification) {
            return $notification->type === 'App\Notifications\DonationRequested';
        });
    }

    /**
     * Retrieve all incoming donations of a donor
     *
     * @return \App\Donation[]
     **/
    public function incomingDonations(User $user)
    {
        $donationIds = $this->findAllUnreadByUser($user)->map(function ($notification) {
            return (int)$notification->data['donation']['id'];
        })->toArray();

        return Donation::find($donationIds);
    }
}
