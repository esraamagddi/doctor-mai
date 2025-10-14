<?php
use Illuminate\Support\Facades\Route;
use Solutions\Team\Http\Controllers\TeamController;
Route::prefix('cp/team')->middleware(['web', 'auth'])->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('team.index')->middleware('perm:team.view');
        Route::get('/create', [TeamController::class, 'create'])->name('team.create')->middleware('perm:team.view');
        Route::post('/', [TeamController::class, 'store'])->name('team.store')->middleware('perm:team.create');
        Route::get('/{team}/edit', [TeamController::class, 'edit'])->name('team.edit')->middleware('perm:team.edit');
        Route::put('/{team}', [TeamController::class, 'update'])->name('team.update')->middleware('perm:team.edit');
        Route::delete('/{team}', [TeamController::class, 'destroy'])->name('team.destroy')->middleware('perm:team.delete');
        Route::post('/{team}/toggle', [TeamController::class, 'toggleStatus'])->name('team.toggle')->middleware('perm:team.edit');
        Route::post('/order', [TeamController::class, 'updateOrder'])->name('team.order')->middleware('perm:team.edit');
    });