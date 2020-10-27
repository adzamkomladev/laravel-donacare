<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Location;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use JWTAuth;

class AuthController extends Controller
{
    public function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Register a user.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telephone' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['patient', 'donor'])],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 400);
        }

        $user = User::create([
            'telephone' => $request['telephone'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'otp' => rand(123456, 987654)
        ]);

        event(new Registered($user));

        if ($token = JWTAuth::attempt(['telephone' => $request['telephone'], 'password' => $request['password']])) {
            $requestData = $request->all();
            $user = User::findOrFail(auth()->user()->id);

            if ($user->location) {
                $user->location()->update([
                    'lng' => $requestData['lng'],
                    'lat' => $requestData['lat'],
                ]);
            } else {
                $location = Location::create([
                    'lng' => $requestData['lng'],
                    'lat' => $requestData['lat'],
                ]);

                $user->location_id = $location->id;
                $user->save();
            }

            return response([
                'error' => false,
                'payload' => $this->createNewToken($token)
            ], 200);
        } else {
            $payload = ["message" => 'Unauthorized'];
            return response([
                'error' => true,
                'payload' => $payload
            ], 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    protected function createNewToken($token)
    {
        auth()->user()->refresh();
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ];
    }

    /**
     * Login into the application.
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telephone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => ['errors' => $validator->errors()->all()]
            ], 400);
        }

        if ($token = JWTAuth::attempt(['telephone' => $request['telephone'], 'password' => $request['password']])) {
            $requestData = $request->all();
            $user = User::findOrFail(auth()->user()->id);

            if ($user->location) {
                $user->location()->update([
                    'lng' => $requestData['lng'],
                    'lat' => $requestData['lat'],
                ]);
            } else {
                $location = Location::create([
                    'lng' => $requestData['lng'],
                    'lat' => $requestData['lat'],
                ]);

                $user->location_id = $location->id;
                $user->save();
            }

            return response([
                'error' => false,
                'payload' => $this->createNewToken($token)
            ], 200);
        } else {
            $payload = ["message" => 'Unauthorized'];
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
    public function logout(Request $request)
    {
        auth()->logout();

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
                Rule::exists('users')->where(function ($query) use ($request) {
                    $query->where('id', $request->user()->id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload' => $validator->errors()->all()
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

    public function currentUser(Request $request)
    {
        return $request->user();
    }

    /**
     * Refresh a token.
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function refresh()
    {
        return response([
            'error' => false,
            'payload' => $this->createNewToken(auth()->refresh())
        ]);
    }
}
