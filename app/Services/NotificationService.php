<?php

namespace App\Services;

use App\User;

class NotificationService
{
    /**
     * Retrieve all unread notifications of a user
     *
     * @return collection
     **/
    public function findAllUnreadByUser(User $user)
    {
        return $user->unreadNotifications->filter(function ($notification) {
            return $notification->type === 'App\Notifications\DonationRequested';
        });
    }
}
