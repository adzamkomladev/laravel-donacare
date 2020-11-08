<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\HospitalService;
use Illuminate\Http\Request;

class AllHospitals extends Controller
{
    /** @var \App\Services\HospitalService $hospitalService  */
    protected $hospitalService;

    public function __construct(HospitalService $hospitalService)
    {
        $this->hospitalService = $hospitalService;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response([
            'error' => false,
            'payload' => [
                'hospitals' => $this->hospitalService->findAll()
            ]
        ]);
    }
}
