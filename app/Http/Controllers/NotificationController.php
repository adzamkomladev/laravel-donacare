<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function newDonationsNotifications(User $user)
    {
       return $user->unreadNotifications->filter(function ($notification) {
           return $notification->type === 'App\Notifications\DonationRequested';
       });
    }
}
