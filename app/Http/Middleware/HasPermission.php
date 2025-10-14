<?php

namespace App\Http\Middleware;

use Closure;

class HasPermission
{
    public function handle($request, Closure $next, $key)
    {
        // ✅ استثناء أول أدمن
        if (auth()->check() && auth()->id() === 1) {
            return $next($request);
        }

        if (!auth()->check() || !auth()->user()->canKey($key)) {
            abort(403);
        }

        return $next($request);
    }
}
