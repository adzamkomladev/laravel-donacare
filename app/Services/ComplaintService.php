<?php

namespace App\Services;

use App\Complaint;
use Carbon\Carbon;

class ComplaintService
{
    /**
     * Paginated complaints in the database.
     *
     * @return \App\Complaint[]
     **/
    public function findAll()
    {
        return Complaint::paginate(6);
    }

    /**
     * Create a new complaint
     **/
    public function create(array $complaintData)
    {
        Complaint::create($complaintData);
    }

    /**
     * Address a complaint
     *
     * @return \App\Complaint
     **/
    public function address(Complaint $complaint, array $complaintData)
    {
        $complaintData['status'] = 'addressed';
        $complaintData['address_date'] = Carbon::now()->toDateTimeString();
        $complaint->update($complaintData);

        return $complaint;
    }
}
