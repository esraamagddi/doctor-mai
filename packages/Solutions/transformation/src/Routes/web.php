<?php

use Illuminate\Support\Facades\Route;
use Solutions\Transformation\Http\Controllers\TransformationController;

Route::prefix('cp/transformations')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [TransformationController::class, 'index'])->name('transformations.index')->middleware('perm:transformations.view');
    Route::get('/create', [TransformationController::class, 'create'])->name('transformations.create')->middleware('perm:transformations.add');
    Route::post('/', [TransformationController::class, 'store'])->name('transformations.store')->middleware('perm:transformations.add');
    Route::get('/{transformation}/edit', [TransformationController::class, 'edit'])->name('transformations.edit')->middleware('perm:transformations.edit');
    Route::put('/{transformation}', [TransformationController::class, 'update'])->name('transformations.update')->middleware('perm:transformations.edit');
    Route::delete('/{transformation}', [TransformationController::class, 'destroy'])->name('transformations.destroy')->middleware('perm:transformations.delete');
});
