<?php

namespace App\Http\Controllers;

use App\Service;
use App\Donation;
use App\File;
use App\Http\Requests\StoreDonation;
use App\Notifications\DonationRequested;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
            $donations  = Donation::with(['donor', 'patient', 'service'])->paginate(6);
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
     * Show the form for creating a new resource
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $services = Service::all();

        return view('donations.create', [
            'services' => $services,
            'type' => $request->query('type')
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  StoreDonation  $request
     * @return Response
     */
    public function store(StoreDonation $request)
    {
        $validated = $request->validated();

        $validated['date_needed'] = Carbon::parse($validated['date_needed']);
        $validated['status'] = 'initiated';

        $donation = Donation::create($validated);

        $images = collect(json_decode($request->all()['images']))->map(function ($image) {
            return ['path' => $image];
        })->toArray();

        $donation->files()->createMany($images);

        $donation->load('patient');

        $donation->refresh();

        $donors = User::ofRole('donor')->get();

        Notification::send($donors, new DonationRequested($donation));

        return $donation;
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
     * Select donor for donation.
     *
     * @param Request $request
     * @param Donation $donation
     * @return Response
     */
    public function deselectDonor(Request $request, Donation $donation)
    {
        Validator::make($request->all(), [
            'donor_id' => 'required|integer|exists:users,id',
        ])->validate();

        if ($donation->donor_id !== $request['donor_id']) {
            return response([
                'message' => 'Not allowed'
            ], 405);
        }

        $donation->update([
            'donor_id' => null,
            'status' => 'initiated'
        ]);

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
