<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_id', 'location_id', 'description',
        'hospital_name', 'date_needed', 'payment_status', 'payment_method',
        'hospital_location', 'share_location', 'type', 'status', 'value',
        'cost', 'quantity', 'value_type'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['files', 'patient'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $appends = ['formatted_cost'];

    public function getFormattedCostAttribute()
    {
        return round($this->cost / 100.0, 2);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donationDonors()
    {
        return $this->hasMany(DonationDonor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
