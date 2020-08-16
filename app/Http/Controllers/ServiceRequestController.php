<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequestStepOne;
use App\Service;
use App\ServiceRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;

        $serviceRequests = [];

        if ($role === 'admin') {
            $serviceRequests  = ServiceRequest::with(['provider', 'service'])->paginate(6);
        } else if ($role === 'provider') {
            $serviceRequests  =
                ServiceRequest::with(['patient', 'service'])->where('provider_id', Auth::id())->paginate(6);
        } else {
            $serviceRequests  =
                ServiceRequest::with(['provider', 'service'])->where('patient_id', Auth::id())->paginate(6);
        }

        return view('service_requests.index', ['serviceRequests' => $serviceRequests]);
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepOne()
    {
        $services = Service::all();

        return view('service_requests.create_step_one', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage: step one
     *
     * @param  StoreServiceRequestStepOne  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStepOne(StoreServiceRequestStepOne $request)
    {
        $validated = $request->validated();
        $validated['patient_id'] = Auth::id();

        $serviceRequest = ServiceRequest::create($validated);

        return redirect()->route('service-requests.create.step-two', [
            'serviceRequest' => $serviceRequest->id
        ]);
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @param  ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function createStepTwo(ServiceRequest $serviceRequest)
    {
        return view('service_requests.create_step_two', [
            'serviceRequest' => $serviceRequest
        ]);
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @param  ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function createStepThree(ServiceRequest $serviceRequest)
    {
        $providers = User::ofRole('provider')->get();

        return view('service_requests.create_step_three', [
            'serviceRequest' => $serviceRequest,
            'providers' => $providers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        return view('service_requests.show', ['serviceRequest' => $serviceRequest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Select provider for service request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function selectProvider(Request $request, ServiceRequest $serviceRequest)
    {
        Validator::make($request->all(), [
            'provider_id' => 'required|integer|exists:users,id',
        ])->validate();

        $serviceRequest->update($request->all());

        return $serviceRequest;
    }
}
