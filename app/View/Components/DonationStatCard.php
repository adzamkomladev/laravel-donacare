<?php

namespace App\View\Components;

use App\Services\DonationService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DonationStatCard extends Component
{
    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    /** @var \App\Services\NotificationService $notificationService  */
    protected $notificationService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DonationService $donationService, NotificationService $notificationService)
    {
        $this->donationService = $donationService;
        $this->notificationService = $notificationService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.donation-stat-card');
    }

    public function donations()
    {
        $user = Auth::user();

        if ($user->role === 'patient') {
            return $this->donationService
                ->activeDonationsOfUser($user)
                ->count();
        }

        if ($user->role === 'donor') {
            return count($this->notificationService->incomingDonations($user));
        }

        return $this->donationService
            ->findAllForUser($user)
            ->count();
    }

    public function text()
    {
        $user = Auth::user();

        if ($user->role === 'patient') {
            return 'Active donations';
        }

        if ($user->role === 'donor') {
            return 'Incoming donations';
        }

        return 'All Donations';
    }
}
