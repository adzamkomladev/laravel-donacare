<?php

namespace App\Services;

use App\Donation;
use App\DonationDonor;
use App\Notifications\DonationRequested;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Services\PrescriptionService;
use Prophecy\Promise\ReturnPromise;

class DonationService
{
    /** @var \App\Services\PrescriptionService $prescriptionService  */
    protected $prescriptionService;

    public function __construct(PrescriptionService $prescriptionService)
    {
        $this->prescriptionService = $prescriptionService;
    }

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
     * Get all donations for a user
     *
     * @return array
     **/
    public function findAllForUser(User $user)
    {
        $donations = [];

        if ($user->role === 'admin') {
            $donations  = Donation::with(['donationDonors', 'patient', 'service'])->get();
        } else if ($user->role === 'donor') {
            $donationIds = DonationDonor::where('user_id', $user->id)
                ->get()
                ->pluck('donation_id')
                ->toArray();

            $donations  = Donation::with(['patient', 'donationDonors', 'service'])
                ->whereIn('id', $donationIds)
                ->get();
        } else {
            $donations  =
                Donation::with(['donationDonors', 'service'])->where('user_id', $user->id)->get();
        }

        return $donations;
    }

    /**
     * Get all pending donations for a user
     *
     * @return \App\Donation[]
     **/
    public function findAllPendingForUser(User $user)
    {
        $donations = [];

        if ($user->role === 'patient') {
            $donations  = $user->donations->filter(function ($donation) {
                return $donation->donationDonors->count() === 0;
            })->values();
        }

        return $donations;
    }

    /**
     * Find a donation by id
     *
     * @return \App\Donation;
     **/
    public function findById(int $id)
    {
        return Donation::with(['patient', 'donor'])->where('id', $id)->first();
    }

    /**
     * Store donation request in storage
     *
     * @return App\Donation
     **/
    public function store(array $validatedData, $images, bool $isWebRequest = true)
    {
        $validatedData['date_needed'] = Carbon::parse($validatedData['date_needed']);
        $validatedData['status'] = 'initiated';
        $validatedData['service_id'] = 2;

        $donation = Donation::create($validatedData);

        if ($isWebRequest) {
            if (count($images) > 0) {
                $this->prescriptionService->createManyFromFiles($images, $donation);
            }
        } else {
            $this->prescriptionService->createManyFromFileUrls($images, $donation);
        }

        $donation->load('patient', 'donationDonors');

        $donors = User::ofRole('donor')->get()->filter(function ($donor) use ($donation) {
            return $donor->profile->blood_group === $donation->patient->profile->blood_group;
        });

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

    /**
     * Assign a donor a donation request
     *
     * @return App\Donation|null
     **/
    public function assignToDonor(array $requestData)
    {
        $donation = Donation::find($requestData['donation_id']);

        if ($donation->status === 'assigned') {
            return null;
        }

        $requestData['blood_unit_name'] = $donation->hospital_name;
        $requestData['blood_unit_location'] = $donation->hospital_location;

        DonationDonor::create($requestData);

        $donation->refresh();

        $isDonationRequestSatisfied = count($donation->donationDonors) == (int)$donation->value;

        if ($isDonationRequestSatisfied) {
            $donation->update([
                'status' => 'assigned'
            ]);

            DB::table('notifications')
                ->where('type', 'App\Notifications\DonationRequested')
                ->where('data->donation->id', $donation->id)
                ->delete();
        }

        return $donation;
    }

    /**
     * Unassign a donor a donation request
     *
     * @return \App\Donation
     **/
    public function unassignDonor(DonationDonor $donationDonor)
    {
        $donationDonor->donation()->update([
            'status' => 'initiated'
        ]);

        $donation = $donationDonor->donation;

        $donationDonor->delete();

        $donation->refresh();

        $donors = User::ofRole('donor')->get();
        Notification::send($donors, new DonationRequested($donation));

        return $donation;
    }

    /**
     * Unassign a donor a donation request
     *
     * @return \App\Donation
     **/
    public function updateDonationDonor(DonationDonor $donationDonor, array $requestData)
    {
        if (array_key_exists('date_donated', $requestData)) {
            $requestData['date_donated'] = Carbon::parse($requestData['date_donated']);
        }


        $donationDonor->update($requestData);

        return $donationDonor;
    }

    /**
     * The current / active donation of a user
     *
     * @return \App\Donation
     **/
    public function activeDonationOfUser(User $user)
    {
        if ($user->role === 'donor') {
            return $this->activeDonationsOfDonor($user)->first();
        }

        if ($user->role === 'patient') {
            return $this->activeDonationsOfPatient($user)->first();
        }
    }

    /**
     * The current / active donations of a user
     *
     * @return \App\Donation[]|Collection
     **/
    public function activeDonationsOfUser(User $user)
    {
        if ($user->role === 'donor') {
            return $this->activeDonationsOfDonor($user)->values();
        }

        if ($user->role === 'patient') {
            return $this->activeDonationsOfPatient($user)->values();
        }
    }

    /**
     * Active donations of a donor
     *
     * @return \App\Donation[]|Collection
     **/
    private function activeDonationsOfDonor(User $user)
    {
        return DonationDonor::with(['donation'])
            ->where('user_id', $user->id)
            ->get()
            ->filter(function ($donationDonor) {
                return count($donationDonor->donation->donationDonors) > 0;
            })
            ->sortBy(function ($donationDonor) {
                return $donationDonor->created_at;
            })->map(function ($donationDonor) {
                return $donationDonor->donation;
            });
    }

    /**
     * Active donations of a patient
     *
     * @return \App\Donation[]|Collection
     **/
    private function activeDonationsOfPatient(User $user)
    {
        return Donation::with(['donationDonors'])
            ->where('user_id', $user->id)
            ->where('status', 'initiated')
            ->orWhere('status', 'assigned')
            ->get()
            ->filter(function ($donation) {
                return count($donation->donationDonors) > 0;
            });
    }
}
