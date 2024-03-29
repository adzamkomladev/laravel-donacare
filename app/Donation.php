<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_id', 'hospital_id', 'description',
        'date_needed', 'payment_status', 'payment_method',
        'share_location', 'type', 'status', 'value',
        'cost', 'quantity', 'value_type'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['files', 'patient', 'hospital'];

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

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeIsAvailable(Builder $query)
    {
        return $query->where('status', 'initiated')->orWhere('status', 'assigned');
    }

    public function scopeIsNotExpired(Builder $query)
    {
        return $query->whereDate('date_needed', '>=', Carbon::now());
    }

    /**
     * Scope a query to only include users of a given role.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanMakeDonation(Builder $query, string $bloodGroup)
    {
        return $query->whereIn('value', config('bloodgroups.' . $bloodGroup)['gives']);
    }
}
