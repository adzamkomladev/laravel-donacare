<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTelephoneVerificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $otp = $event->user->otp;
        $phone = $event->user->telephone;
        $tawkToApiKey = env('TAWK_TO_KEY');

        Log::info('Registered user OTP', ['otp' => $otp, 'phone' => $phone, 'api_key' => $tawkToApiKey]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sms.to/sms/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"message\": \"Hello! Your PIN for Blood-donor is {$otp}\",\n    \"to\": \"{$phone}\",\n    \"sender_id\": \"SMSto\",\n    \"callback_url\": \"https://example.com/callback/handler\"\n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Accept: application/json",
                "Authorization: Bearer {$tawkToApiKey}"
            ),
        ));

        $response = curl_exec($curl);

        Log::info('cURL response', ['response' => $response]);

        curl_close($curl);
    }
}
