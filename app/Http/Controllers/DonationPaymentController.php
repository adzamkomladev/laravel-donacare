<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Services\DonationService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;

class DonationPaymentController extends Controller
{
    /** @var \App\Services\PaymentService $paymentService  */
    protected $paymentService;

    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(PaymentService $paymentService, DonationService $donationService)
    {
        $this->paymentService = $paymentService;
        $this->donationService = $donationService;
    }

    public function index()
    {
        return view('donation_payments.index', [
            'payments' => $this->paymentService->findAllByUserId(Auth::id()),
        ]);
    }

    public function confirm(Payment $payment)
    {
        $this->paymentService->confirm($payment);
        $this->donationService->updateStatus(['status' => 'done'], $payment->donation);

        return redirect()->back();
    }
}
