<?php

namespace App\Http\Controllers;

use App\DonationDonor;
use App\Http\Requests\AssignDonation;
use App\Http\Requests\UpdateDonationDonor;
use App\Services\DonationService;
use Illuminate\Http\Request;

class DonationDonorController extends Controller
{

    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AssignDonation $request)
    {
        return
            $this->donationService->assignToDonor($request->validated())
            ??
            response(['errors' => [
                ['message' => 'Donation request has already been assigned!']
            ]], 405);
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonationDonor $request, DonationDonor $donationDonor)
    {
        return $this->donationService->updateDonationDonor($donationDonor, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DonationDonor  $donationDonor
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationDonor $donationDonor)
    {
        return $this->donationService->unassignDonor($donationDonor);
    }
}
