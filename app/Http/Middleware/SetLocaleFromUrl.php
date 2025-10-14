<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Solutions\Language\Models\Language as ModelsLanguage;

class SetLocaleFromUrl
{
    public function handle($request, Closure $next)
    {
        // Get first segment from URL (e.g., "ar" from "/ar/aboutus")
        $locale = $request->segment(1);

        // Fetch supported languages from DB
        $languages = ModelsLanguage::pluck('code')->toArray();

        // Fetch default locale (you could also use config('app.locale'))
        $defaultLocale = ModelsLanguage::where('is_default', 1)->value('code') ?? config('app.locale');

        if (in_array($locale, $languages)) {
            // Set app locale to URL segment
            App::setLocale($locale);
        } else {
            // If not prefixed or invalid, fallback to default
            App::setLocale($defaultLocale);
        }

        // Optional: share the current locale with all views
        View::share('currentLocale', App::getLocale());

        return $next($request);
    }
}
