<?php

use Illuminate\Support\Facades\Route;
use Solutions\AboutUs\Http\Controllers\AboutUsController;

Route::prefix('cp/about-us')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [AboutUsController::class, 'index'])->name('aboutus.index')->middleware('perm:aboutus.view');
    Route::post('/', [AboutUsController::class, 'store'])->name('aboutus.store')->middleware('perm:aboutus.view');
});
