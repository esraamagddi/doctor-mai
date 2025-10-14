<?php

use Illuminate\Support\Facades\Route;
use Solutions\AccessControl\Http\Controllers\RoleController;
use Solutions\AccessControl\Http\Controllers\PermissionController;

Route::prefix('cp')->middleware(['web', 'auth'])->group(function () {

    // Roles
    Route::get('roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('perm:roles.view');

    Route::get('roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('perm:roles.create');

    Route::post('roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('perm:roles.create');

    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('perm:roles.edit');

    Route::put('roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('perm:roles.edit');

    Route::delete('roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('perm:roles.delete');

    // Permissions
    Route::get('permissions/sync', [PermissionController::class, 'sync'])
        ->name('permissions.sync')
        ->middleware('perm:permissions.sync');

    Route::get('permissions/delete/{id}', [PermissionController::class, 'delete'])
        ->name('permissions.delete')
        ->middleware('perm:permissions.delete');
});
