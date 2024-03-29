<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\Controller;
use App\Notifications\DonationRequested;
use App\Services\DonationService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DonationController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userDonations($id)
    {
        try {
            $user = User::findOrFail($id);
            $role = $user->role;

            $donations = [];

            if ($role === 'admin') {
                $donations  = Donation::with(['donor', 'patient', 'service']);
            } else if ($role === 'donor') {
                $donations  =
                    Donation::with(['patient', 'service'])->where('donor_id', $id);
            } else {
                $donations  =
                    Donation::with(['donor', 'service'])->where('patient_id', $id);
            }

            return response([
                'error' => false,
                'payload' => ['donations' => $donations]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'User not found']
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'value' => 'required|string',
            'value_type' => 'required|string',
            'hospital_id' => 'required|integer|exists:hospitals,id',
            'description' => 'nullable|string',
            'date_needed' => 'required',
            'payment_status' => ['required', Rule::in(['free', 'charged'])],
            'payment_method' => 'sometimes|string',
            'share_location' => 'required|boolean',
            'type' => ['required', Rule::in(['blood', 'organ', 'funds'])],
            'quantity' => 'required|integer',
            //'service_id' => 'required|integer|exists:services,id',
            'cost' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 422);
        }

        $validated = $request->all();
        $imageUrls = $validated['images'] ?? [];

        $donation = $this->donationService->store($validated, $imageUrls, false);

        return response([
            'error' => false,
            'payload' => ['donation' => $donation]
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
