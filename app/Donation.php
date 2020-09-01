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
        'patient_id', 'donor_id', 'service_id', 'location_id', 'description',
        'hospital_name', 'date_needed', 'payment_status', 'payment_method',
        'hospital_location', 'doctor_name', 'doctor_phone', 'doctor_staff_id',
        'share_location', 'type', 'status', 'value', 'cost'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['files', 'patient', 'donor'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
