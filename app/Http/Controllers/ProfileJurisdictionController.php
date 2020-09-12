<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileJurisdictionController extends Controller
{
    /** @var \App\Services\ProfileService $profileService  */
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the form for editing profile jurisdiction.
     *
     * @param Profile $profile
     * @return Application|Factory|Response|View
     */
    public function edit(Profile $profile)
    {
        return view('profile_jurisdictions.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \App\Profile
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = Validator::make($request->all(), [
            'jurisdiction' => 'required|string|max:100',
        ])->validated();

        return $this->profileService->updateJurisdiction($profile, $validated['jurisdiction']);
    }
}
