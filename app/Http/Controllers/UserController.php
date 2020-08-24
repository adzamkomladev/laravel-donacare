<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\ServiceRequest;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['toggleActivation', 'serviceRequests']);
        $this->middleware(CheckOTP::class)->except(['toggleActivation', 'serviceRequests']);
        $this->middleware(CheckProfile::class)->except(['toggleActivation', 'serviceRequests']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(6);

        return view('users.index', ['users' => $users]);
    }

    /**
     * All service requests of user.
     *
     * @param User $user
     * @return ServiceRequest[]|Collection|Response
     */
    public function serviceRequests(User $user)
    {
        if ($user->role === 'patient') {
            return ServiceRequest::with(['donor', 'patient', 'service'])->where('patient_id', $user->id)->get();
        }

        if ($user->role === 'donor') {
            return ServiceRequest::with(['donor', 'patient', 'service'])->where('donor_id', $user->id)->get();
        }

        return ServiceRequest::with(['donor', 'patient', 'service'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Toggle user activation.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function toggleActivation(Request $request, User $user)
    {
        $user->activated = !$user->activated;
        $user->save();

        return response()->json(['message' => 'No Content'], 204);
    }
}
