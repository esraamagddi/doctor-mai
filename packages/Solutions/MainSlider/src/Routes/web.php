<?php

use Illuminate\Support\Facades\Route;
use Solutions\MainSlider\Http\Controllers\MainSliderController;

Route::prefix('cp/main-slider')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [MainSliderController::class, 'index'])
        ->name('mainslider.index')
        ->middleware('perm:mainslider.view');

    Route::get('/create', [MainSliderController::class, 'create'])
        ->name('mainslider.create')
        ->middleware('perm:mainslider.create');

    Route::post('/', [MainSliderController::class, 'store'])
        ->name('mainslider.store')
        ->middleware('perm:mainslider.create');

    Route::get('/{mainSlider}/edit', [MainSliderController::class, 'edit'])
        ->name('mainslider.edit')
        ->middleware('perm:mainslider.edit');

    Route::put('/{mainSlider}', [MainSliderController::class, 'update'])
        ->name('mainslider.update')
        ->middleware('perm:mainslider.edit');

    Route::delete('/{mainSlider}', [MainSliderController::class, 'destroy'])
        ->name('mainslider.destroy')
        ->middleware('perm:mainslider.delete');

    Route::post('/{mainSlider}/toggle', [MainSliderController::class, 'toggleStatus'])
        ->name('mainslider.toggle')
        ->middleware('perm:mainslider.toggle');

    Route::post('/order', [MainSliderController::class, 'updateOrder'])
        ->name('mainslider.order')
        ->middleware('perm:mainslider.order');
});
