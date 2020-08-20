<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Register a user.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'telephone' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload'=>$validator->errors()->all()
            ], 422);
        }

        $user = User::create([
            'telephone' => $request['telephone'],
            'password' => Hash::make($request['password']),
            'otp' => rand(123456, 987654)
        ]);

        event(new \Illuminate\Auth\Events\Registered($user));

        $token = $user->createToken('Blood donor application')->accessToken;

        $payload = ['token' => $token, 'user' => $user];
        return response([
            'error' => false,
            'payload' => $payload
        ], 200);
    }

    /**
     * Login into the application.
     *
     * @param Request $request
     * @return Response
     */
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'telephone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
          return response([
                'error' => true,
                'payload'=>$validator->errors()->all()
            ], 422);
        }

        if (Auth::attempt(['telephone' => $request['telephone'], 'password' => $request['password']])) {
                $user = Auth::user();
                $token = $user->createToken('Blood donor application')->accessToken;

                $payload = ['token' => $token, 'user' => $user];
                return response([
                    'error' => false,
                    'payload' => $payload
                ], 200);
        } else {
            $payload = ["message" =>'Unauthorized'];
            return response([
                'error' => true,
                'payload' => $payload
            ], 401);
        }
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        $payload = ['message' => 'You have been successfully logged out!'];
        return response([
            'error' => false,
            'payload' => $payload
        ], 200);
    }

    /**
     * Verify OTP.
     *
     * @param Request $request
     * @return Response
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => [
                'required',
                'numeric',
                'min:6',
                Rule::exists('users')->where(function ($query) use($request) {
                    $query->where('id', $request->user()->id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload'=>$validator->errors()->all()
            ], 422);
        }

        $user = User::find($request->user()->id);
        $user->telephone_verified_at = now();
        $user->save();

        $payload = ['user' => $user];
        return response([
            'error' => false,
            'payload' => $payload
        ], 200);
    }
}
