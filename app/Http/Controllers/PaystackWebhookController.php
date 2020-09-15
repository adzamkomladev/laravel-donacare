<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Digikraaft\PaystackWebhooks\Http\Controllers\WebhooksController as PaystackWebhooksController;

class PaystackWebhookController extends PaystackWebhooksController
{
    /**
     * Handle charge success.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleChargeSuccess($payload)
    {
        dd($payload);
    }
}
