<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepOneStoreProfile;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class StepOneProfileCreationController extends Controller
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
        return view('profiles.step_one');
    }

    /**
     * Step one of profile form
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StepOneStoreProfile $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $this->profileService->saveStepOneData($validated);

        return redirect()->route('profiles.create_step_two');
    }
}
