<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DonationService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSummary extends Controller
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

            $dashboardSummary = [
                'pending_donations' =>  count($this->donationService->findAllPendingForUser($user)),
                'active_donations' => count($this->donationService->activeDonationsOfUser($user)),
                'cancelled_donations' => count($this->donationService->findAllCancelledForUser($user)),
                'confirmed_donations' => count($this->donationService->findAllConfirmedForUser($user)),
                'completed_donations' => count($this->donationService->findAllCompletedForUser($user)),
            ];

            return response([
                'error' => false,
                'payload' => [
                    'dashboard_summary' => $dashboardSummary
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
