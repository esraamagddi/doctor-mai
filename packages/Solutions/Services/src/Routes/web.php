<?php
use Illuminate\Support\Facades\Route;
use Solutions\Services\Http\Controllers\ServicesController;

Route::prefix('cp/services')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [ServicesController::class, 'index'])
        ->name('services.index')
        ->middleware('perm:services.view');

    Route::get('/create', [ServicesController::class, 'create'])
        ->name('services.create')
        ->middleware('perm:services.create');

    Route::post('/', [ServicesController::class, 'store'])
        ->name('services.store')
        ->middleware('perm:services.create');

    Route::get('/{service}/edit', [ServicesController::class, 'edit'])
        ->name('services.edit')
        ->middleware('perm:services.edit');

    Route::put('/{service}', [ServicesController::class, 'update'])
        ->name('services.update')
        ->middleware('perm:services.edit');

    Route::delete('/{service}', [ServicesController::class, 'destroy'])
        ->name('services.destroy')
        ->middleware('perm:services.delete');

    Route::post('/{service}/toggle', [ServicesController::class, 'toggleStatus'])
        ->name('services.toggle')
        ->middleware('perm:services.toggle');

    Route::post('/order', [ServicesController::class, 'updateOrder'])
        ->name('services.order')
        ->middleware('perm:services.order');
});
