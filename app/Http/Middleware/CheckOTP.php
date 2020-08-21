<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOTP
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->otp || !$request->user()->telephone_verified_at) {
            if ($request->expectsJson()) {
                return response([
                    'error' => true,
                    'payload'=> ['message' => 'OTP has not been verified']
                ], 422);
            }

            return redirect()->route('otp-verification');
        }

        return $next($request);
    }
}
