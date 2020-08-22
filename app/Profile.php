<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'other_names',
        'gender', 'avatar', 'blood_group', 'mobile_money_name',
        'mobile_money_number', 'home_address', 'medical_details',
        'email'
    ];

    protected $appends = [
        'full_name', 'avatar_url'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->other_names} {$this->last_name}";
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('img/' . $this->avatar) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
