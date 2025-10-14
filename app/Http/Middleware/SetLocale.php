<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Solutions\Language\Models\Language;

class SetLocale {
    public function handle($request, Closure $next) {
        $code = Session::get('admin_locale')
            ?: optional(Language::where('status',1)->where('is_default',1)->first())->code
            ?: config('app.locale');

        App::setLocale($code);

        // شارك الاتجاه لكل الفيوز
        $dir = optional(Language::where('code',$code)->first())->dir ?: 'ltr';
        view()->share('dir', $dir);

        return $next($request);
    }
}
