<?php

namespace App\Observers;

use App\Donation;
use App\History;

class DonationObserver
{
    /**
     * Handle the donation "created" event.
     *
     * @param  \App\Donation  $donation
     * @return void
     */
    public function created(Donation $donation)
    {
        $donation->load('patient');
        History::create(['type' => 'donation', 'data' => $donation]);
    }

    /**
     * Handle the donation "updated" event.
     *
     * @param  \App\Donation  $donation
     * @return void
     */
    public function updated(Donation $donation)
    {
        $donation->load('patient');
        History::create(['type' => 'donation', 'data' => $donation]);
    }
}
