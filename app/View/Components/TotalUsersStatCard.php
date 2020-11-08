<?php

namespace App\View\Components;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class TotalUsersStatCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.total-users-stat-card');
    }

    public function totalUsers()
    {
        if (Auth::user()->role ===  'donor') {
            return User::ofRole('patient')->get()->count();
        }

        if (Auth::user()->role ===  'patient') {
            return User::ofRole('donor')->get()->count();
        }

        return User::all()->count();
    }

    public function text()
    {
        $text = 'Total users';

        if (Auth::user()->role === 'donor') {
            $text = 'Total patients';
        }

        if (Auth::user()->role === 'patient') {
            $text = 'Total donors';
        }

        return $text;
    }
}
