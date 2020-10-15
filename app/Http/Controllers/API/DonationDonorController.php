<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\DonationDonor;
use App\Services\DonationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationDonorController extends Controller
{

    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donation_id' => 'required|integer|exists:donations,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 422);
        }

        $donation = $this->donationService->assignToDonor($request->all());

        if (!$donation) {
            return response(['errors' => [
                ['message' => 'Donation request has already been assigned!']
            ]], 405);
        }

        return response([
            'error' => false,
            'payload' => ['donation' => $donation]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'blood_unit_name' => 'sometimes|string',
            'blood_unit_location' => 'sometimes|string',
            'date_donated' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 422);
        }

        try {
            $donationDonor = DonationDonor::findOrFail($id);

            return response([
                'error' => false,
                'payload' => [
                    'donationDonor' => $this->donationService->updateDonationDonor($donationDonor, $request->all())
                ]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'Donation donor not found']
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $donationDonor = DonationDonor::findOrFail($id);

            return response([
                'error' => false,
                'payload' => [
                    'donation' => $this->donationService->unassignDonor($donationDonor)
                ]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'Donation donor not found']
            ], 404);
        }
    }
}
