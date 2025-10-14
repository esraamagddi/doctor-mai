<?php

use Illuminate\Support\Facades\Route;
use Solutions\Seo\Http\Controllers\SeoController;

Route::middleware(['web','auth'])
    ->prefix('cp')
    ->group(function () {
        Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
        Route::get('/seo/create', [SeoController::class, 'create'])->name('seo.create');
        Route::post('/seo', [SeoController::class, 'store'])->name('seo.store');
        Route::get('/seo/{page}/edit', [SeoController::class, 'edit'])->name('seo.edit');
        Route::put('/seo/{page}', [SeoController::class, 'update'])->name('seo.update');
        Route::delete('/seo/{page}', [SeoController::class, 'destroy'])->name('seo.destroy');
        Route::post('/seo/{page}/toggle', [SeoController::class, 'toggleStatus'])->name('seo.toggle');
        Route::post('/seo/order', [SeoController::class, 'updateOrder'])->name('seo.order');
    });
