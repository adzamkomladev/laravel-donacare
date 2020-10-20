<?php

namespace App\Services;

use App\Donation;
use App\DonationDonor;
use App\Payment;
use App\User;

class PaymentService
{
    /**
     * All Payments by a user in the database.
     *
     * @return \App\Payment[]
     **/
    public function findAllByUserId(int $id)
    {
        return Payment::with('donationDonor')->get()->filter(function ($payment) use ($id) {
            return $payment->donationDonor->user_id === $id;
        });
    }

    /**
     * All Payments by a user in the database.
     **/
    public function confirm(Payment $payment)
    {
        $payment->update(['confirmed' => true]);
    }

    /**
     * Initiate the payment process
     *
     * @return array
     **/
    public function initiatePayment(DonationDonor $donationDonor, User $user)
    {
        $cost = $donationDonor->donation->cost;
        $quantity = (int)$donationDonor->donation->quantity;

        $amount = ceil($cost / $quantity);

        $paymentData = [
            'name' => $user->profile->full_name,
            'amount' => $amount,
            'currency' => 'GHS',
            'quantity' => 1,
            'email' => $user->profile->email,
            'reference' => 'donacare-' . time(),
            'orderID' => time(),
            'callback_url' => route('verify-payment')
        ];

        /** Initiate the client for url's */
        $curl = curl_init();

        /** Curl array values to be passed */
        curl_setopt_array($curl, [

            /** The url to visit and get response from */
            CURLOPT_URL => config('paystack.paymentUrl') . '/transaction/initialize',

            /** The curl options should have return transfer values */
            CURLOPT_RETURNTRANSFER => true,

            /** Specify the encoding if necessary: omitted here */
            CURLOPT_ENCODING => '',

            /** The maximum redirect the link can have */
            CURLOPT_MAXREDIRS => 10,

            /** The time out for the load time can be set here */
            CURLOPT_TIMEOUT => 30000,

            /** The version for the curl can be set here */
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            /** The request being sent to the endpoint is a POST request */
            CURLOPT_CUSTOMREQUEST => 'POST',

            /** The fields returned should be json encoded */
            CURLOPT_POSTFIELDS => json_encode($paymentData),

            CURLOPT_HTTPHEADER => [
                /** The headers for the curl array can be set here: Auth_key */
                'accept: */*',
                'authorization: Bearer ' . config('paystack.publicKey'),
                'accept-language: en-US,en;q=0.8',
                'content-type: application/json',
            ]
        ]);

        /** The response gotten from the client for urls */
        $response = curl_exec($curl);

        /** If errors exist then return the error messages */
        $err = curl_error($curl);

        /** Close the connection to the end point once done */
        curl_close($curl);

        if (!$err) {
            $donationDonor->payment()->create([
                'ref' => $paymentData['reference'],
                'platform' => 'paystack',
                'amount' => $amount,
                'confirmed' => false,
            ]);
        }

        return [
            'error' => $err,
            'response' => $response
        ];
    }

    /**
     * All Payments by a user in the database.
     *
     * @return \App\Payment[]
     **/
    public function findAllByUser(User $user)
    {
        if ($user->role === 'patient') {
            $donationIds = Donation::where('user_id', $user->id)->get()->pluck('id')->toArray();

            return
                Payment::with('donationDonor')->get()->filter(function ($payment) use ($donationIds) {
                    return in_array($payment->donationDonor->donation_id, $donationIds);
                });
        }

        return Payment::with('donationDonor')->get()->filter(function ($payment) use ($user) {
            return $payment->donationDonor->user_id === $user->id;
        });
    }
}
