<?php

namespace App\Http\Controllers;

use App\File;
use App\ServiceRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ServiceRequest $serviceRequest)
    {
        $path = $request->file->store('public/service-requests');

        $file = File::create([
            'path' => substr($path, 7),
            'service_request_id' => $serviceRequest->id
        ]);

        return response()->json(['success' => $file->path]);
    }
}
