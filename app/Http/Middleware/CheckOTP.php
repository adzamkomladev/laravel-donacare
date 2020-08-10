<?php

namespace App\Http\Middleware;

use Closure;

class CheckOTP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->otp || !$request->user()->telephone_verified_at) {
            return redirect()->route('otp-verification');
        }

        return $next($request);
    }
}
