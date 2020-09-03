<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'other_names' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'mobile_money_name' => 'required|string|max:100',
            'mobile_money_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:100',
            'type' => ['nullable' , Rule::in(['organ', 'blood', 'funds'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'medical_details' => 'nullable|string',
            'home_address' => 'nullable|string|max:100',
            'jurisdiction' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload'=> ['errors' => $validator->errors()->all()]
            ], 422);
        }

        $profileData = $request->all();
        $profileData['user_id'] = Auth::id();

        $user = User::find($profileData['user_id']);
        $user->update(['role' => $request['role']]);

        $profile = Profile::create($profileData);

        return response([
            'error' => false,
            'payload' => ['profile' => $profile]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $profile = Profile::findOrFail($id);

            return response([
                'error' => false,
                'payload' => ['profile' => $profile]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'Profile not found']
            ], 404);
        }
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'other_names' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'mobile_money_name' => 'required|string|max:100',
            'mobile_money_number' => 'required|string|max:15',
            'blood_group' => 'required|string|max:100',
            'type' => ['nullable' , Rule::in(['organ', 'blood', 'funds'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'medical_details' => 'nullable|string',
            'home_address' => 'nullable|string|max:100',
            'jurisdiction' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload'=> ['errors' => $validator->errors()->all()]
            ], 422);
        }

        try {
            $profile = Profile::findOrFail($id);

            $profile->update($request->all());

            return response([
                'error' => false,
                'payload' => ['profile' => $profile]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'Profile not found']
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
