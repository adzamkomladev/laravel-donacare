<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Http\Requests\StoreHospital;
use App\Services\HospitalService;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /** @var \App\Services\HospitalService $hospitalService  */
    protected $hospitalService;

    public function __construct(HospitalService $hospitalService)
    {
        $this->hospitalService = $hospitalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hospitals.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreHospital $request)
    {
        return $this->hospitalService->create($request->validated());
    }
}
