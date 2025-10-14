<?php

use Illuminate\Support\Facades\Route;
use Solutions\Users\Http\Controllers\UserController;

Route::middleware(['web','auth'])->prefix('cp')->group(function () {

    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('perm:users.view');

    Route::get('users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('perm:users.create');

    Route::post('users', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('perm:users.create');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('perm:users.edit');

    Route::put('users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('perm:users.edit');

    Route::delete('users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('perm:users.delete');
});
