<?php

namespace App\View\Components;

use App\Services\DonationService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class TotalDonationsStatCard extends Component
{
    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.total-donations-stat-card');
    }

    /**
     * All Donations By the user
     *
     * @return \App\Donation[]
     **/
    public function totalDonations()
    {
        return count($this->donations());
    }

    /**
     * All Donations By the user
     *
     * @return \App\Donation[]
     **/
    private function donations()
    {
        return $this->donationService->findAllForUser(Auth::user());
    }
}
