<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donation_id', 'name', 'path',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
