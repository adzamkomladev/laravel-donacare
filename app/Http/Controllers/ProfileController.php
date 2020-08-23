<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Http\Requests\StepOneStoreProfile;
use App\Http\Requests\StepTwoStoreProfile;
use App\Http\Requests\StoreProfile;
use App\Profile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'update', 'updateJurisdiction', 'createStepOne',
            'storeStepOne', 'createStepTwo', 'storeStepTwo'
        ]);
        $this->middleware(CheckOTP::class)->except([
            'update', 'updateJurisdiction', 'createStepOne',
            'storeStepOne', 'createStepTwo', 'storeStepTwo'
        ]);
        $this->middleware(CheckProfile::class)->except([
            'createStepOne', 'storeStepOne', 'createStepTwo', 'storeStepTwo',
            'store', 'update', 'updateJurisdiction'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function createStepOne()
    {
        return view('profiles.step_one');
    }

    /**
     * Step one of profile form
     *
     * @param StepOneStoreProfile $request
     * @return RedirectResponse
     */
    public function storeStepOne(StepOneStoreProfile $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $request->session()->put('step_one', $validated);

        return redirect()->route('profiles.create-step-two');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function createStepTwo()
    {
        return view('profiles.step_two');
    }

    /**
     * Step two of profile form
     *
     * @param StepTwoStoreProfile $request
     * @return RedirectResponse
     */
    public function storeStepTwo(StepTwoStoreProfile $request)
    {
        $validated = $request->validated();
        $stepOne = $request->session()->get('step_one');
        $profileData = collect($validated)->merge($stepOne)->all();

        $profile = Profile::create($profileData);

        $profile->user->role = $profileData['role'];
        $profile->user->save();

        $request->session()->forget('step_one');

        return redirect()->route('home');
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
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return Response
     */
    public function edit(Profile $profile)
    {
        //
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

        $profile->update($request->all());

        return $profile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @return Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return Application|Factory|Response|View
     */
    public function editJurisdiction(Profile $profile)
    {
        return view('profiles.update-jurisdiction', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return Profile
     */
    public function updateJurisdiction(Request $request, Profile $profile)
    {
        Validator::make($request->all(), [
            'jurisdiction' => 'required|string|max:100',
        ])->validate();

        $profile->update($request->all());

        return $profile;
    }
}
