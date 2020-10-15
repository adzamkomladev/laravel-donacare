<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetting;
use App\Services\SettingService;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /** @var \App\Services\settingService $settingService  */
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('settings.show', [
            'setting' => $this->settingService->findLatest()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSetting $request)
    {
        return $this->settingService->create($request->validated(), $request->input('user_id'));
    }
}
