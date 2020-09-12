<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepTwoStoreProfile;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class StepTwoProfileCreationController extends Controller
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
        return view('profiles.step_two', [
            'stepOne' => $this->profileService->getStepOneData()
        ]);
    }

    /**
     * Step two of profile form
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StepTwoStoreProfile $request)
    {
        $validated = $request->validated();

        $profile = $this->profileService->create($validated);

        return redirect()->route('home');
    }
}
