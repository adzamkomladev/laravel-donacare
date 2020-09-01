<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Http\Middleware\CheckOTP;
use App\Http\Middleware\CheckProfile;
use App\Http\Requests\StoreComplaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::paginate(6);

//        dd($complaints);

        return view('complaints.index', ['complaints' => $complaints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaint $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();


        Complaint::create($validated);

        return redirect()->route('complaints.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complaint  $complaint
     * @return \App\Complaint
     */
    public function update(Request $request, Complaint $complaint)
    {
        Validator::make($request->all(), [
            'response' => 'required|string',
        ])->validate();

        $complaint->update($request->all());
        $complaint->status = 'addressed';
        $complaint->address_date = Carbon::now()->toDateTimeString();
        $complaint->save();

        return $complaint;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
