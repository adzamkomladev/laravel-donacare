<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /** @var \App\Services\NotificationService $notificationService  */
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function newDonationsNotifications(User $user)
    {
        return $this->notificationService->findAllUnreadByUser($user);
    }
}
