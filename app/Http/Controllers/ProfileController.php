<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProfile;
use App\Profile;
use App\Services\ProfileService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /** @var \App\Services\ProfileService $profileService  */
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Profile
     */
    public function store(StoreProfile $request, User $user)
    {
        return $this->profileService->ccreate($user, $request->validated());
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \App\Profile
     */
    public function update(Request $request, Profile $profile)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'other_names' => 'nullable|string|max:100',
            'home_address' => 'nullable|string|max:100',
        ])->validate();

        return $this->profileService->update($profile, $request->all());
    }
}
