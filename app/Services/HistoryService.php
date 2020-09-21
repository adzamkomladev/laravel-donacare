<?php

namespace App\Services;

use App\History;
use App\User;

class HistoryService
{
    /**
     * Get history based on currently authenticated user
     *
     *
     * @return History[]
     **/
    public function findAllByUser(User $user)
    {
        if ($user->role === 'admin') {
            return History::paginate(6);
        }

        if ($user->role === 'donor') {
            return History::where('data->donation->donor_id', $user->id)->paginate(6);
        }

        return  History::where('data->patient_id', $user->id)->paginate(6);
    }
}
