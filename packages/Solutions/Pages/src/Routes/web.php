<?php

use Illuminate\Support\Facades\Route;
use Solutions\Pages\Http\Controllers\PageController;

Route::prefix('cp')->middleware(['web','auth'])->group(function () {
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('/pages/{page}/toggle', [PageController::class, 'toggleStatus'])->name('pages.toggle');
    Route::post('/pages/order', [PageController::class, 'updateOrder'])->name('pages.order');
});
