<?php
use Illuminate\Support\Facades\Route;
use Solutions\UserProfile\Http\Controllers\ProfileController;

Route::middleware(['web','auth'])->prefix('cp')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});