<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Paystack;

class PaymentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckOTP::class);
        $this->middleware(CheckProfile::class);
    }

    public function index(){
        return view('payment.index');
    }
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        dd($request);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
