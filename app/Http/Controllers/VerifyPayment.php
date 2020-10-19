<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class VerifyPayment extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /** Initialize the client for urls */
        $curl = curl_init();

        /** Check for a reference and return else make empty */
        $reference = $request->get('reference');

        if (!$reference) {
            return redirect()->route('home');
        }

        $payment = Payment::where('ref', $reference)->first();

        if (!$payment) {
            return redirect()->route('home');
        }


        /** Set the client for url's array values for the Curl's */
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('paystack.paymentUrl') . "/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,

            /** Set the client for url header values passed */
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer " . config('paystack.publicKey'),
                "cache-control: no-cache"
            ],
        ));

        /** The response should be executed if successful */
        $response = curl_exec($curl);

        /** If there's an error return the error message */
        $err = curl_error($curl);

        if ($err) {
            return redirect()->route('donation-donors.index', [
                'donation' => $payment->donationDonor->donation_id
            ]);
        }

        /** The transaction details and stats would be returned */
        $trans = json_decode($response);
        if (!$trans->status) {
            return redirect()->route('donation-donors.index', [
                'donation' => $payment->donationDonor->donation_id
            ]);
        }

        /** If the transaction stats are successful snd to DB */
        if ('success' == $trans->data->status) {
            $payment->txdata = json_encode($trans);
            $payment->confirmed = true;
            $payment->save();

            return redirect()->route('donation-donors.index', [
                'donation' => $payment->donationDonor->donation_id
            ]);
        }
    }
}
