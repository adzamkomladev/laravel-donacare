<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Donation;
use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{

    public function index(Donation $donation)
    {
        return view('payment.index', ['donation' => $donation]);
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        return redirect()->route('donations.index');

        //dd($request);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
