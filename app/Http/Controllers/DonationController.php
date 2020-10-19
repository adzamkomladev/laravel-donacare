<?php

namespace App\Http\Controllers;

use App\Service;
use App\Donation;
use App\Http\Requests\StoreDonation;
use App\Services\DonationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    /** @var DonationService $donationService  */
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
        return view('donations.index', [
            'donations' => $this->donationService->findAllForUser(Auth::user())
        ]);
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
        return $this->donationService->store($validated, $request->file('images'));
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
        if ($donation->status === 'assigned') {
            return response(['errors' => [
                ['message' => 'Donation request has already been assigned!']
            ]], 405);
        }

        Validator::make($request->all(), [
            'donor_id' => 'required|integer|exists:users,id',
        ])->validate();

        $donationData = $request->all();

        return $this->donationService->assignDonation($donationData, $donation);
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

        return $this->donationService->unassignDonation($donation);
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

        return $this->donationService->updateStatus($request->all(), $donation);
    }
}
