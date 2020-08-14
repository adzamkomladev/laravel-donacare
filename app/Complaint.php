<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id', 'description', 'title', 'log_date', 'address_date', 'status', 'response'
    ];

    protected $casts = [
        'log_date' => 'datetime',
        'address_date' => 'datetime',
    ];

//    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();;
    }
}
