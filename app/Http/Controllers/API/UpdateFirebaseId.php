<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateFirebaseId extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firebase_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 422);
        }

        try {
            $user = User::findOrFail(Auth::id());

            $user->firebase_id = $request->input('firebase_id');
            $user->save();

            return response([
                'error' => false,
                'payload' => [
                    'user' => $user
                ]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'User not found']
            ], 404);
        }
    }
}
