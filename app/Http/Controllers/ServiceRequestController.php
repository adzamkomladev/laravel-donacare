<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequestStepOne;
use App\Http\Requests\StoreServiceRequestStepTwo;
use App\Service;
use App\ServiceRequest;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $role = Auth::user()->role;

        $serviceRequests = [];

        if ($role === 'admin') {
            $serviceRequests  = ServiceRequest::with(['donor', 'service'])->paginate(6);
        } else if ($role === 'donor') {
            $serviceRequests  =
                ServiceRequest::with(['patient', 'service'])->where('donor_id', Auth::id())->paginate(6);
        } else {
            $serviceRequests  =
                ServiceRequest::with(['donor', 'service'])->where('patient_id', Auth::id())->paginate(6);
        }

        return view('service_requests.index', ['serviceRequests' => $serviceRequests]);
    }

    /**
     * All service requests for frontend API.
     *
     * @return ServiceRequest[]|Collection|Response
     */
    public function allServiceRequests()
    {
        return ServiceRequest::all();
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @return Response
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
     * @return Response
     */
    public function storeStepOne(StoreServiceRequestStepOne $request)
    {
        $validated = $request->validated();
        $validated['patient_id'] = Auth::id();
        $validated['service_price'] = Service::find($validated['service_id'])->price;

        $request->session()->put('step_one', $validated);

        return redirect()->route('service-requests.create.step-two');
    }

    /**
     * Show the form for creating a new resource: step two
     *
     * @param  Request  $request
     * @return Response
     */
    public function createStepTwo(Request $request)
    {
        return view('service_requests.create_step_two', [
            'step_one' => $request->session()->get('step_one')
        ]);
    }

    /**
     * Store a newly created resource in storage: step two
     *
     * @param  StoreServiceRequestStepTwo  $request
     * @return Response
     */
    public function storeStepTwo(StoreServiceRequestStepTwo $request)
    {
        $validated = $request->validated();
        $stepOne = $request->session()->get('step_one');
        $serviceRequestData = collect($validated)->merge($stepOne)->all();

        $serviceRequest = ServiceRequest::create($serviceRequestData);

        $request->session()->forget('step_one');

        return redirect()->route('service-requests.create.step-three', [
            'serviceRequest' => $serviceRequest->id
        ]);
    }

    /**
     * Show the form for creating a new resource: step three
     *
     * @param  ServiceRequest  $serviceRequest
     * @return Response
     */
    public function createStepThree(ServiceRequest $serviceRequest)
    {
        return view('service_requests.create_step_three', [
            'serviceRequest' => $serviceRequest
        ]);
    }

    /**
     * Show the form for creating a new resource: step one
     *
     * @param  ServiceRequest  $serviceRequest
     * @return Response
     */
    public function createStepFour(ServiceRequest $serviceRequest)
    {
        $donors = User::ofRole('donor')->get();

        return view('service_requests.create_step_four', [
            'serviceRequest' => $serviceRequest,
            'donors' => $donors
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        return view('service_requests.show', ['serviceRequest' => $serviceRequest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Select donor for service request.
     *
     * @param Request $request
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function selectDonor(Request $request, ServiceRequest $serviceRequest)
    {
        Validator::make($request->all(), [
            'donor_id' => 'required|integer|exists:users,id',
        ])->validate();

        $serviceRequestData = $request->all();
        $serviceRequestData['status'] = 'assigned';

        $serviceRequest->update($serviceRequestData);

        return $serviceRequest;
    }

    /**
     * Update service request status.
     *
     * @param Request $request
     * @param ServiceRequest $serviceRequest
     * @return Response
     */
    public function updateStatus(Request $request, ServiceRequest $serviceRequest)
    {
        Validator::make($request->all(), [
            'status' => [
                'required',
                Rule::in([
                    'initiated',
                    'incomplete',
                    'assigned',
                    'completed',
                    'done',
                    'pending'
                ])
            ],
        ])->validate();

        $serviceRequest->update($request->all());

        return $serviceRequest;
    }
}
