<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Services\DonationService;
use Illuminate\Http\Request;

class ShowETAMap extends Controller
{
    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $id)
    {
        return view('eta_maps.index', [
            'donation' => $this->donationService->findById($id)
        ]);
    }
}
