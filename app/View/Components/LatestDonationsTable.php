<?php

namespace App\View\Components;

use App\Services\DonationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class LatestDonationsTable extends Component
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
        return view('components.latest-donations-table');
    }

    /**
     *
     * @return \App\Donation[]
     */
    public function donations()
    {
        return $this->donationService->findAllForUser(Auth::user());
    }
}
