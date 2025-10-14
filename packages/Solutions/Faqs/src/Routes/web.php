<?php
use Illuminate\Support\Facades\Route;
use Solutions\Faqs\Http\Controllers\FaqController;
use Solutions\Faqs\Http\Controllers\FaqCategoryController;

Route::prefix('cp/faqs')->middleware(['web','auth'])->group(function () {

    // FAQ items
    Route::get('/', [FaqController::class, 'index'])
        ->name('faqs.index')
        ->middleware('perm:faqs.view');

    Route::get('/create', [FaqController::class, 'create'])
        ->name('faqs.create')
        ->middleware('perm:faqs.create');

    Route::post('/', [FaqController::class, 'store'])
        ->name('faqs.store')
        ->middleware('perm:faqs.create');

    Route::get('/{faq}/edit', [FaqController::class, 'edit'])
        ->name('faqs.edit')
        ->middleware('perm:faqs.edit');

    Route::put('/{faq}', [FaqController::class, 'update'])
        ->name('faqs.update')
        ->middleware('perm:faqs.edit');

    Route::delete('/{faq}', [FaqController::class, 'destroy'])
        ->name('faqs.destroy')
        ->middleware('perm:faqs.delete');

    Route::post('/{faq}/toggle', [FaqController::class, 'toggleStatus'])
        ->name('faqs.toggle')
        ->middleware('perm:faqs.toggle');

    Route::post('/order', [FaqController::class, 'updateOrder'])
        ->name('faqs.order')
        ->middleware('perm:faqs.order');

    // FAQ Categories
    Route::prefix('categories')->group(function () {

        Route::get('/', [FaqCategoryController::class, 'index'])
            ->name('faqs.categories.index')
            ->middleware('perm:faqs.categories.view');

        Route::get('/create', [FaqCategoryController::class, 'create'])
            ->name('faqs.categories.create')
            ->middleware('perm:faqs.categories.create');

        Route::post('/', [FaqCategoryController::class, 'store'])
            ->name('faqs.categories.store')
            ->middleware('perm:faqs.categories.create');

        Route::get('/{category}/edit', [FaqCategoryController::class, 'edit'])
            ->name('faqs.categories.edit')
            ->middleware('perm:faqs.categories.edit');

        Route::put('/{category}', [FaqCategoryController::class, 'update'])
            ->name('faqs.categories.update')
            ->middleware('perm:faqs.categories.edit');

        Route::delete('/{category}', [FaqCategoryController::class, 'destroy'])
            ->name('faqs.categories.destroy')
            ->middleware('perm:faqs.categories.delete');

        Route::post('/{category}/toggle', [FaqCategoryController::class, 'toggleStatus'])
            ->name('faqs.categories.toggle')
            ->middleware('perm:faqs.categories.toggle');

        Route::post('/order', [FaqCategoryController::class, 'updateOrder'])
            ->name('faqs.categories.order')
            ->middleware('perm:faqs.categories.order');
    });
});

