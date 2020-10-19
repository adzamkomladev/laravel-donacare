<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Donation;
use App\Services\DonationService;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
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
     * All donations of user.
     *
     * @param User $user
     * @return Donation[]|Collection|Response
     */
    public function donations(User $user)
    {
        return $this->donationService->findAllForUser($user);
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
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function showDonors()
    {
        $donors = User::whereHas('profile', function ($query) {
            return $query->where('blood_group', '=', Auth::user()->profile->blood_group);
        })->ofRole('donor')->get();

        return view('users.donors', ['donors' => $donors]);
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
