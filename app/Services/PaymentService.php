<?php

namespace App\Services;

use App\Payment;

class PaymentService
{
    /**
     * All Payments by a user in the database.
     *
     * @return \App\Payment[]
     **/
    public function findAllByUserId(int $id)
    {
        return Payment::with('donation')->get()->filter(function ($payment) use ($id) {
            return $payment->donation->donor_id === $id;
        });
    }

    /**
     * All Payments by a user in the database.
     **/
    public function confirm(Payment $payment)
    {
        $payment->update(['confirmed' => true]);
    }
}
