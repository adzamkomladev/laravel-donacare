<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationStepOne;
use App\Http\Requests\StoreDonationStepTwo;
use App\Service;
use App\Donation;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $role = Auth::user()->role;

        $donations = [];

        if ($role === 'admin') {
            $donations  = Donation::with(['donor', 'service'])->paginate(6);
        } else if ($role === 'donor') {
            $donations  =
                Donation::with(['patient', 'service'])->where('donor_id', Auth::id())->paginate(6);
        } else {
            $donations  =
                Donation::with(['donor', 'service'])->where('patient_id', Auth::id())->paginate(6);
        }

        return view('donations.index', ['donations' => $donations]);
    }

    /**
     * All donations for frontend API.
     *
     * @return Donation[]|Collection|Response
     */
    public function allDonations()
    {
        return Donation::all();
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @return Response
     */
    public function createStepOne()
    {
        $services = Service::all();

        return view('donations.create_step_one', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage: step one
     *
     * @param  StoreDonationStepOne  $request
     * @return Response
     */
    public function storeStepOne(StoreDonationStepOne $request)
    {
        $validated = $request->validated();
        $validated['patient_id'] = Auth::id();
        $validated['service_price'] = Service::find($validated['service_id'])->price;

        $request->session()->put('step_one', $validated);

        return redirect()->route('donations.create.step-two');
    }

    /**
     * Show the form for creating a new resource: step two
     *
     * @param  Request  $request
     * @return Response
     */
    public function createStepTwo(Request $request)
    {
        return view('donations.create_step_two', [
            'step_one' => $request->session()->get('step_one')
        ]);
    }

    /**
     * Store a newly created resource in storage: step two
     *
     * @param  StoreDonationStepTwo  $request
     * @return Response
     */
    public function storeStepTwo(StoreDonationStepTwo $request)
    {
        $validated = $request->validated();
        $stepOne = $request->session()->get('step_one');
        $donationData = collect($validated)->merge($stepOne)->all();

        $donation = Donation::create($donationData);

        $request->session()->forget('step_one');

        return redirect()->route('donations.create.step-three', [
            'donation' => $donation->id
        ]);
    }

    /**
     * Show the form for creating a new resource: step three
     *
     * @param  Donation  $donation
     * @return Response
     */
    public function createStepThree(Donation $donation)
    {
        return view('donations.create_step_three', [
            'donation' => $donation
        ]);
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @param  Donation  $donation
     * @return Response
     */
    public function createStepFour(Donation $donation)
    {
        $donors = User::ofRole('donor')->get();

        return view('donations.create_step_four', [
            'donation' => $donation,
            'donors' => $donors
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Donation $donation
     * @return Response
     */
    public function show(Donation $donation)
    {
        return view('donations.show', ['donation' => $donation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Donation $donation
     * @return Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Donation $donation
     * @return Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Donation $donation
     * @return Response
     */
    public function destroy(Donation $donation)
    {
        //
    }

    /**
     * Select donor for donation.
     *
     * @param Request $request
     * @param Donation $donation
     * @return Response
     */
    public function selectDonor(Request $request, Donation $donation)
    {
        Validator::make($request->all(), [
            'donor_id' => 'required|integer|exists:users,id',
        ])->validate();

        $donationData = $request->all();
        $donationData['status'] = 'assigned';

        $donation->update($donationData);

        return $donation;
    }

    /**
     * Update donation status.
     *
     * @param Request $request
     * @param Donation $donation
     * @return Response
     */
    public function updateStatus(Request $request, Donation $donation)
    {
        Validator::make($request->all(), [
            'status' => [
                'required',
                Rule::in([
                    'initiated',
                    'incomplete',
                    'assigned',
                    'completed',
                    'done',
                    'pending'
                ])
            ],
        ])->validate();

        $donation->update($request->all());

        return $donation;
    }
}
