<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// JWT contract
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telephone', 'role', 'password', 'activated', 'otp', 'firebase_id', 'location_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'telephone_verified_at' => 'datetime',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['profile', 'location', 'complaint'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Scope a query to only include users of a given role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope a query to only include users of a given role.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanDonateTo(Builder $query, string $bloodGroup)
    {
        foreach (config('bloodgroups.' . $bloodGroup)['receives'] as $key => $bg) {
            if ($key == 0) {
                $query->where(function ($query) {
                    $query->select('blood_group')
                    ->from('profiles')
                    ->whereColumn('user_id', 'users.id')
                    ->limit(1);
                }, $bg);

                continue;
            }
            $query->orWhere(function ($query) {
                $query->select('blood_group')
                ->from('profiles')
                ->whereColumn('user_id', 'users.id')
                ->limit(1);
            }, $bg);
        }

        return $query;
    }

    /**
     * Scope a query to only include users of a given role.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanReceiveFrom(Builder $query, string $bloodGroup)
    {
        foreach (config('bloodgroups.' . $bloodGroup)['gives'] as $key => $bg) {
            if ($key == 0) {
                $query->where(function ($query) {
                    $query->select('blood_group')
                    ->from('profiles')
                    ->whereColumn('user_id', 'users.id')
                    ->limit(1);
                }, $bg);

                continue;
            }
            $query->orWhere(function ($query) {
                $query->select('blood_group')
                ->from('profiles')
                ->whereColumn('user_id', 'users.id')
                ->limit(1);
            }, $bg);
        }

        return $query;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function donationDonors()
    {
        return $this->hasMany(DonationDonor::class);
    }
}
