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
        'donation_id', 'type', 'amount', 'confirmed', 'part_payment'
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
