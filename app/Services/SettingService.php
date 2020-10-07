<?php

namespace App\Services;

use App\Setting;

class SettingService
{
    /**
     * Find latest setting
     *
     * @return \App\File[]
     **/
    public function findLatest()
    {
        return Setting::with('user')->latest()->first();
    }

    /**
     * Create a setting
     *
     * @return \App\Setting
     **/
    public function create(array $data, int $userId)
    {
        return Setting::create([
            'user_id' => $userId,
            'data' => json_encode($data)
        ]);
    }
}
