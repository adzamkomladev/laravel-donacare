<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 'activated',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['location'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
