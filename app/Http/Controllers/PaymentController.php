<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{

    public function index(Request $request, Donation $donation)
    {
        dd($request);
        return view('payment.index', ['donation' => $donation]);
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {

        $data = [
            'amount' => 1,
            'user' => 'Komla Adzam',
            'email' => 'adzamkomla.dev@gmail.com',
            'currency' => 'GHS',
            'orderID' => rand(18227, 29398423),
            'quantity' => 1,
            'reference' => 'dkdjdkjf-' . rand(18227, 29398423),
            'callback_url' => route('payments.paid')
        ];

        /** Initiate the client for url's */
        $curl = curl_init();

        /** Curl array values to be passed */
        curl_setopt_array($curl, array(

            /** The url to visit and get response from */
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",

            /** The curl options should have return transfer values */
            CURLOPT_RETURNTRANSFER => true,

            /** Specify the encoding if necessary: omitted here */
            CURLOPT_ENCODING => "",

            /** The maximum redirect the link can have */
            CURLOPT_MAXREDIRS => 10,

            /** The time out for the load time can be set here */
            CURLOPT_TIMEOUT => 30000,

            /** The version for the curl can be set here */
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            /** The request being sent to the endpoint is a POST request */
            CURLOPT_CUSTOMREQUEST => "POST",

            /** The fields returned should be json encoded */
            CURLOPT_POSTFIELDS => json_encode($data1),

            CURLOPT_HTTPHEADER => [

                /** The headers for the curl array can be set here: Auth_key */
                "accept: */*",
                "authorization: Bearer sk_test_ef8a9ef63bc98540ebda09d685a087ccfec5ea3c",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ]
        ));

        /** The response gotten from the client for urls */
        $response = curl_exec($curl);

        /** If errors exist then return the error messages */
        $err = curl_error($curl);

        /** Close the connection to the end point once done */
        curl_close($curl);

        /** If there are errors then echo them out  */
        if ($err) {

            echo "cURL Error #:" . $err;
        } else {

            /** This should send the data from the Callback with transaction details */
            $trans = json_decode($response, true);
            return redirect($trans['data']['authorization_url']);
        }
        // return Paystack::getAuthorizationUrl()->redirectNow();
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

        dd($paymentDetails);
    }

    public function myPaid(Request $request)
    {
        /** Initialize the client for urls */
        $curl = curl_init();

        /** Check for a reference and return else make empty */
        $reference = $request->get('reference');
        if (!$reference) {
            die('No reference supplied');
        }

        /** Set the client for url's array values for the Curl's */
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,

            /** Set the client for url header values passed */
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_ef8a9ef63bc98540ebda09d685a087ccfec5ea3c",
                "cache-control: no-cache"
            ],
        ));

        /** The response should be executed if successful */
        $response = curl_exec($curl);

        /** If there's an error return the error message */
        $err = curl_error($curl);

        if($err){
            dd('Api returned error' . $err);
        }

        /** The transaction details and stats would be returned */
        $trans = json_decode($response);
        if(!$trans->status){
            dd('Api returned Error' . $trans->message);
        }

        /** If the transaction stats are successful snd to DB */
        if('success' == $trans->data->status){
           dd($trans);
        }

        dd($request);
    }
}
