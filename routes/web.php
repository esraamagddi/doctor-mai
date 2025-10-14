<?php

use Illuminate\Support\Facades\Route;
use Solutions\Language\Models\Language;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\SetLocaleFromUrl;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\VideoController;
use App\Http\Controllers\Front\AboutUsController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\FrontLanguageController;
use App\Http\Controllers\Front\ServicesController;
use App\Http\Controllers\Front\AppointmentFormController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Frontend Routes with Language Prefix
|--------------------------------------------------------------------------
*/
$languages = Language::all();

foreach ($languages as $language) {
    $prefix = $language->is_default  == 1 ? '' :  $language->code;
    $namePrefix = $language->code . '.';


    Route::prefix($prefix)
        ->as($namePrefix)
        ->middleware(SetLocaleFromUrl::class)
        ->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');
            Route::get('/faq', [FaqController::class, 'index'])->name('faq');
            Route::get('/blog', [BlogController::class, 'index'])->name('blog');
            Route::get('/blog/{id}', [BlogController::class, 'blogDetails'])->name('blog.details');
            Route::get('/video', [VideoController::class, 'videos'])->name('video');
            Route::get('/video/{id}', [VideoController::class, 'videoDetails'])->name('video.details');
            Route::get('/reels', [VideoController::class, 'reels'])->name('reels');
            Route::get('/services', [ServicesController::class, 'index'])->name('services');
            Route::get('/services/{id}', [ServicesController::class, 'Details'])->name('services.details');
            Route::get('/contact', [ContactController::class, 'index'])->name('contact');
            Route::get('/contact/success', [ContactController::class, 'success'])->name('contact.success');
            Route::get('/appointment', [AppointmentFormController::class, 'index'])->name('appointment');
            Route::get('/appointment/success', [AppointmentFormController::class, 'success'])->name('appointment.success');
            Route::get('/privacy', [PageController::class, 'show'])->defaults('slug', 'privacy')->name('privacy');
        });
}

/*
|--------------------------------------------------------------------------
| Form Submissions (no prefix)
|--------------------------------------------------------------------------
*/
Route::post('/contact', [ContactController::class, 'store'])->name('front.contact.store');
Route::post('/appointment', [AppointmentFormController::class, 'store'])->name('appointment.store');

/*
|--------------------------------------------------------------------------
| Language Switcher
|--------------------------------------------------------------------------
*/
Route::get('switch-language/{code}', [FrontLanguageController::class, 'switch'])->name('language.switch');
