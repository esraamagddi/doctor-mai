<?php
use Illuminate\Support\Facades\Route;
use Solutions\SectionHeaders\Http\Controllers\SectionHeaderController;

Route::prefix('cp')->middleware(['web','auth'])->group(function () {

    Route::get('/section-headers', [SectionHeaderController::class, 'index'])
        ->name('sectionheaders.index')
        ->middleware('perm:sectionheaders.view');

    Route::get('/section-headers/create', [SectionHeaderController::class, 'create'])
        ->name('sectionheaders.create')
        ->middleware('perm:sectionheaders.create');

    Route::post('/section-headers', [SectionHeaderController::class, 'store'])
        ->name('sectionheaders.store')
        ->middleware('perm:sectionheaders.create');

    Route::get('/section-headers/{header}/edit', [SectionHeaderController::class, 'edit'])
        ->name('sectionheaders.edit')
        ->middleware('perm:sectionheaders.edit');

    Route::put('/section-headers/{header}', [SectionHeaderController::class, 'update'])
        ->name('sectionheaders.update')
        ->middleware('perm:sectionheaders.edit');

    Route::delete('/section-headers/{header}', [SectionHeaderController::class, 'destroy'])
        ->name('sectionheaders.destroy')
        ->middleware('perm:sectionheaders.delete');

    Route::post('/section-headers/{header}/toggle', [SectionHeaderController::class, 'toggleStatus'])
        ->name('sectionheaders.toggle')
        ->middleware('perm:sectionheaders.toggle');

    Route::post('/section-headers/order', [SectionHeaderController::class, 'updateOrder'])
        ->name('sectionheaders.order')
        ->middleware('perm:sectionheaders.order');
});
