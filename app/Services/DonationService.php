<?php

namespace App\Services;

use App\Donation;
use App\Notifications\DonationRequested;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class DonationService
{
    /**
     * Get all donations based on Authenticated user's role
     *
     * @return array
     **/
    public function findAll()
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

        return $donations;
    }

    /**
     * Store donation request in storage
     *
     * @return App\Donation
     **/
    public function store(array $validatedData, array $imageUrls)
    {
        $validatedData['date_needed'] = Carbon::parse($validatedData['date_needed']);
        $validatedData['status'] = 'initiated';

        $donation = Donation::create($validatedData);

        $images = collect($imageUrls)->map(function ($image) {
            return ['path' => $image];
        })->toArray();

        $donation->files()->createMany($images);

        if ($donation->payment_status === 'free') {
            $donation->payments()->create([
                'type' => $donation->payment_status,
                'amount' => 0.0
            ]);
        }

        $donation->load('patient', 'payments');
        $donation->refresh();

        $donors = User::ofRole('donor')->get();

        Notification::send($donors, new DonationRequested($donation));

        return $donation;
    }

    /**
     * Assign a donation request to a donor
     *
     * @return App\Donation
     **/
    public function assignDonation(array $donationData, Donation $donation)
    {
        $donationData['status'] = 'assigned';

        $donation->update($donationData);

        DB::table('notifications')
            ->where('type', 'App\Notifications\DonationRequested')
            ->where('data->donation->id', $donation->id)
            ->delete();

        return $donation;
    }

    /**
     * Unassign a donation request
     *
     * @return App\Donation
     **/
    public function unassignDonation(Donation $donation)
    {
        $donation->update([
            'donor_id' => null,
            'status' => 'initiated'
        ]);

        $donors = User::ofRole('donor')->get();

        Notification::send($donors, new DonationRequested($donation));

        return $donation;
    }

    /**
     * Update a donation request status
     *
     * @return App\Donation
     **/
    public function updateStatus(array $requestData, Donation $donation)
    {
        $donation->update($requestData);

        return $donation;
    }
}
