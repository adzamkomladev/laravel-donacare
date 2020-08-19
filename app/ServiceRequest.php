<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'donor_id', 'service_id', 'description', 'hospital_name',
        'hospital_contact', 'hospital_location', 'doctor_name', 'doctor_contact', 'status'
    ];

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
}
