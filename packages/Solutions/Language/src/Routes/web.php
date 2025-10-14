<?php
use Illuminate\Support\Facades\Route;
use Solutions\Language\Http\Controllers\LanguageController;

Route::prefix('cp/language')->middleware(['web','auth'])->group(function(){
    Route::get('/', [LanguageController::class, 'index'])
        ->name('language.index')
        ->middleware('perm:language.view');

    Route::get('/create', [LanguageController::class, 'create'])
        ->name('language.create')
        ->middleware('perm:language.create');

    Route::post('/', [LanguageController::class, 'store'])
        ->name('language.store')
        ->middleware('perm:language.create');

    Route::get('/{language}/edit', [LanguageController::class, 'edit'])
        ->name('language.edit')
        ->middleware('perm:language.edit');

    Route::put('/{language}', [LanguageController::class, 'update'])
        ->name('language.update')
        ->middleware('perm:language.edit');

    Route::delete('/{language}', [LanguageController::class, 'destroy'])
        ->name('language.destroy')
        ->middleware('perm:language.delete');

    Route::post('/{language}/toggle', [LanguageController::class, 'toggleStatus'])
        ->name('language.toggle')
        ->middleware('perm:language.toggle');

    Route::post('/{language}/default', [LanguageController::class, 'setDefault'])
        ->name('language.default')
        ->middleware('perm:language.edit');

    Route::post('/order', [LanguageController::class, 'updateOrder'])
        ->name('language.order')
        ->middleware('perm:language.order');

    Route::get('/lang/{code}', [LanguageController::class, 'switchAdmin'])
        ->name('cp.lang.switch');
});
