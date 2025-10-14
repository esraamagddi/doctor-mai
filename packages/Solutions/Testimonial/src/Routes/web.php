<?php
use Illuminate\Support\Facades\Route;
use Solutions\Testimonial\Http\Controllers\TestimonialController;

Route::prefix('cp/testimonial')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [TestimonialController::class, 'index'])
        ->name('testimonial.index')
        ->middleware('perm:testimonial.view');

    Route::get('/create', [TestimonialController::class, 'create'])
        ->name('testimonial.create')
        ->middleware('perm:testimonial.create');

    Route::post('/', [TestimonialController::class, 'store'])
        ->name('testimonial.store')
        ->middleware('perm:testimonial.create');

    Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])
        ->name('testimonial.edit')
        ->middleware('perm:testimonial.edit');

    Route::put('/{testimonial}', [TestimonialController::class, 'update'])
        ->name('testimonial.update')
        ->middleware('perm:testimonial.edit');

    Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])
        ->name('testimonial.destroy')
        ->middleware('perm:testimonial.delete');

    Route::post('/{testimonial}/toggle', [TestimonialController::class, 'toggleStatus'])
        ->name('testimonial.toggle')
        ->middleware('perm:testimonial.toggle');

    Route::post('/order', [TestimonialController::class, 'updateOrder'])
        ->name('testimonial.order')
        ->middleware('perm:testimonial.order');
});
