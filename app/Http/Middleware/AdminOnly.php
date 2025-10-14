<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::id() == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
