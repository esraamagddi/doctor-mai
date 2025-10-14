<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('front_locale', config('app.locale'));
        app()->setLocale($locale);

        return $next($request);
    }
}
