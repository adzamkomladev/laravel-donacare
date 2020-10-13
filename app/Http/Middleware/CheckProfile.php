<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProfile
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
        if (!$request->user()->profile) {
            if ($request->expectsJson()) {
                return response([
                    'error' => true,
                    'payload' => ['message' => 'There is no profile for the user']
                ], 422);
            }

            return redirect()->route('profiles.create');
        }

        return $next($request);
    }
}
