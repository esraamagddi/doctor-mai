<?php

use Illuminate\Support\Facades\Route;
use Solutions\Contact\Http\Controllers\Admin\ContactMessageController;

Route::middleware(['web'])
    ->prefix('cp')
    ->group(function () {

        // لتجنّب تعارض contact/{message} مع contact/bulk
        Route::pattern('message', '[0-9]+');

        // Actions أولاً
        Route::post('contact/bulk', [ContactMessageController::class, 'bulk'])
            ->name('contact.bulk')
            ->middleware('perm:contact.update');

        Route::post('contact/{message}/mark', [ContactMessageController::class, 'mark'])
            ->whereNumber('message')
            ->name('contact.mark')
            ->middleware('perm:contact.update');

        // Index + Show/Delete
        Route::get('contact', [ContactMessageController::class, 'index'])
            ->name('contact.index')
            ->middleware('perm:contact.view');

        Route::get('contact/{message}', [ContactMessageController::class, 'show'])
            ->whereNumber('message')
            ->name('contact.show')
            ->middleware('perm:contact.view');

        Route::delete('contact/{message}', [ContactMessageController::class, 'destroy'])
            ->whereNumber('message')
            ->name('contact.destroy')
            ->middleware('perm:contact.delete');
    });
