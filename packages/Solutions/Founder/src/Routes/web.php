<?php


use Illuminate\Support\Facades\Route;
use Solutions\Founder\Http\Controllers\FounderController;

Route::prefix('cp/founder')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [FounderController::class, 'index'])
        ->name('founder.index')
        ->middleware('perm:founder.view');

    Route::post('/', [FounderController::class, 'store'])
        ->name('founder.store');
});
