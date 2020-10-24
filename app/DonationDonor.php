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
        'user_id', 'donation_id', 'date_donated', 'blood_unit_id',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['bloodUnit'];

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

    public function bloodUnit()
    {
        return $this->hasOne(Hospital::class, 'blood_unit_id');
    }
}
