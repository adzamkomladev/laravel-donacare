<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Http\Requests\StoreComplaint;
use App\Services\ComplaintService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    /** @var \App\Services\ComplaintService $complaintService  */
    protected $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('complaints.index', [
            'complaints' => $this->complaintService->findAll(),
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaint $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $this->complaintService->create($validated);

        return redirect()->route('complaints.index');
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

        return $this->complaintService->address($complaint, $request->all());
    }
}
