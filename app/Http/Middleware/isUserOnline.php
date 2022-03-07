<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;

class isUserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (Auth::guard('user')->user()) {
            $expiresAt = Carbon::now()->addSeconds(10);
            Cache::put('online-' . Auth::guard('user')->user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}