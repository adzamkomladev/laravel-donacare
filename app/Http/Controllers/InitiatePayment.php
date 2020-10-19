<?php

namespace App\Http\Controllers;

use App\DonationDonor;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InitiatePayment extends Controller
{
    /** @var \App\Services\PaymentService $paymentService  */
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, DonationDonor $donationDonor)
    {
        $results = $this->paymentService->initiatePayment($donationDonor, Auth::user());

        if ($results['error']) {
            return redirect()->back();
        }

        /** This should send the data from the Callback with transaction details */
        $trans = json_decode($results['response'], true);

        return redirect($trans['data']['authorization_url']);
    }
}
