<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomingDonations extends Controller
{
    /** @var \App\Services\NotificationService $notificationService  */
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
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
                    'donations' => $this->notificationService->incomingDonations($user)
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
