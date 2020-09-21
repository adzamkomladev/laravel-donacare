<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationPaymentController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $payments = Payment::with('donation')->get()->filter(function ($payment) use ($userId) {
            return $payment->donation->donor_id === $userId;
        });

        return view('donation_payments.index', ['payments' => $payments]);
    }

    public function confirm(Payment $payment)
    {
        $payment->update(['confirmed' => true]);
        $payment->donation()->update(['status' => 'done']);

        return redirect()->back();
    }
}
