<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donation_donor_id', 'platform', 'ref', 'txdata', 'type', 'amount',
        'confirmed', 'part_payment'
    ];

    public function donationDonor()
    {
        return $this->belongsTo(DonationDonor::class);
    }
}
