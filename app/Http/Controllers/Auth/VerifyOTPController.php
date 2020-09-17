<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VerifyOTPController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the form for OTP confirmation.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.verify_otp');
    }

    /**
     * Verify OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => [
                'required',
                'numeric',
                'min:6',
                Rule::exists('users')->where(function ($query) {
                    $query->where('id', Auth::id());
                })
            ],
        ]);

        $user = User::find(Auth::id());
        $user->telephone_verified_at = now();
        $user->save();

        return redirect()->route('profiles.create_step_one');
    }
}
