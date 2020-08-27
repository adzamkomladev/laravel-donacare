<?php

namespace App\Http\Controllers;

use App\File;
use App\Donation;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Donation $donation)
    {
        $path = $request->file->store('public/donations');

        $file = File::create([
            'path' => substr($path, 7),
            'donation_id' => $donation->id
        ]);

        return response()->json(['success' => $file->path]);
    }
}
