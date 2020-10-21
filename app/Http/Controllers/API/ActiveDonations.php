<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DonationService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveDonations extends Controller
{
    /** @var \App\Services\DonationService $donationService  */
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::id());

            return response([
                'error' => false,
                'payload' => [
                    'donations' => $this->donationService->activeDonationsOfUser($user)
                ]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'User not found']
            ], 404);
        }
    }
}
