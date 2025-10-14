<?php
use Illuminate\Support\Facades\Route;
use Solutions\Navbar\Http\Controllers\NavbarController;

Route::prefix('cp')->middleware(['web','auth'])->group(function () {

    Route::get('/navbar', [NavbarController::class, 'index'])
        ->name('navbar.index')
        ->middleware('perm:navbar.view');

    Route::get('/navbar/create', [NavbarController::class, 'create'])
        ->name('navbar.create')
        ->middleware('perm:navbar.create');

    Route::post('/navbar', [NavbarController::class, 'store'])
        ->name('navbar.store')
        ->middleware('perm:navbar.create');

    Route::get('/navbar/{header}/edit', [NavbarController::class, 'edit'])
        ->name('navbar.edit')
        ->middleware('perm:navbar.edit');

    Route::put('/navbar/{header}', [NavbarController::class, 'update'])
        ->name('navbar.update')
        ->middleware('perm:navbar.edit');

    Route::delete('/navbar/{header}', [NavbarController::class, 'destroy'])
        ->name('navbar.destroy')
        ->middleware('perm:navbar.delete');

    Route::post('/navbar/{header}/toggle', [NavbarController::class, 'toggleStatus'])
        ->name('navbar.toggle')
        ->middleware('perm:navbar.toggle');

    Route::post('/navbar/order', [NavbarController::class, 'updateOrder'])
        ->name('navbar.order')
        ->middleware('perm:navbar.order');
});
