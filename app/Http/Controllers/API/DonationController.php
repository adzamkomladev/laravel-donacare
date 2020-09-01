<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonation;
use App\Notifications\DonationRequested;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage
     *
     * @param  StoreDonation  $request
     * @return Response
     */
    public function store(StoreDonation $request)
    {
        $validated = $request->validated();

        $validated['date_needed'] = Carbon::parse($validated['date_needed']);
        $validated['status'] = 'initiated';

        $donation = Donation::create($validated);

        $images = collect(json_decode($request->all()['images']))->map(function ($image) {
            return ['path' => $image];
        })->toArray();

        $donation->files()->createMany($images);

        $donation = Donation::find($donation->id);

        $donors = User::ofRole('donor')->get();

        Notification::send($donors, new DonationRequested($donation));

        return $donation;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
