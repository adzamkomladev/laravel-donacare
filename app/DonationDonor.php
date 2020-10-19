<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationDonor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'donation_id', 'date_donated', 'blood_unit_name', 'blood_unit_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
