<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Http\Requests\StoreService;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(6);

        return view('services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::latest()->paginate(3);

        return view('services.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreService  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreService $request)
    {
        $validated = $request->validated();

        $validated['available'] = true;

        Service::create($validated);

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'available' => 'required|boolean'
        ])->validate();

        $service->update($request->all());

        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    /**
     * Toggle service availability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function toggleAvailability(Request $request, Service $service)
    {
        $service->available = !$service->available;
        $service->save();

        return response()->json(['message' => 'No Content'], 204);
    }
}
