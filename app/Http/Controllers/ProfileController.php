<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProfile;
use App\Profile;
use App\Services\ProfileService;
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
     * Store a newly created resource in storage.
     *
     * @param StoreProfile $request
     * @return RedirectResponse
     */
    public function store(StoreProfile $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $profile = Profile::create($validated);

        $profile->user->role = $validated['role'];
        $profile->user->save();

        return redirect()->route('home');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return Profile
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
