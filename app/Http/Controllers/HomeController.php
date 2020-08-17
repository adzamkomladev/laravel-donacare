<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckOTP::class);
        $this->middleware(CheckProfile::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestUsers = User::latest()->paginate(6);
        $topServices =  Service::all()->sortBy(function ($service) {
            return count($service->serviceRequests);
        })->slice(0, 6);

        return view('home', ['users' => $latestUsers, 'services' => $topServices]);
    }
}
