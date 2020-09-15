<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $latestUsers = User::latest()->paginate(6);
        // $topServices =  Service::all()->sortBy(function ($service) {
        //     return count($service->donations);
        // })->slice(0, 6);

        // return view('home', ['users' => $latestUsers, 'services' => $topServices]);

        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }
}
