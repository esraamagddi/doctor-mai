<?php
use Illuminate\Support\Facades\Route;
use Solutions\Clients\Http\Controllers\ClientController;

Route::prefix('cp/clients')->middleware(['web','auth'])->group(function () {
    Route::get('/', [ClientController::class, 'index'])
        ->name('clients.index')
        ->middleware('perm:clients.view');

    Route::get('/create', [ClientController::class, 'create'])
        ->name('clients.create')
        ->middleware('perm:clients.create');

    Route::post('/', [ClientController::class, 'store'])
        ->name('clients.store')
        ->middleware('perm:clients.create');

    Route::get('/{client}/edit', [ClientController::class, 'edit'])
        ->name('clients.edit')
        ->middleware('perm:clients.edit');

    Route::put('/{client}', [ClientController::class, 'update'])
        ->name('clients.update')
        ->middleware('perm:clients.edit');

    Route::delete('/{client}', [ClientController::class, 'destroy'])
        ->name('clients.destroy')
        ->middleware('perm:clients.delete');
});
