<?php

use Illuminate\Support\Facades\Route;
use Solutions\Media\Http\Controllers\PhotoController;
use Solutions\Media\Http\Controllers\VideoController;
use Solutions\Media\Http\Controllers\VideoCategoryController;

Route::prefix('cp')->middleware(['web', 'auth'])->group(function () {

    // Photo Routes
    Route::get('/photos', [PhotoController::class, 'index'])->name('media.photos.index');
    Route::get('/photos/create', [PhotoController::class, 'create'])->name('media.photos.create');
    Route::post('/photos', [PhotoController::class, 'store'])->name('media.photos.store');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('media.photos.edit');
    Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('media.photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('media.photos.destroy');
    Route::post('/photos/{photo}/toggle', [PhotoController::class, 'toggleStatus'])->name('media.photos.toggle');
    Route::post('/photos/order', [PhotoController::class, 'updateOrder'])->name('media.photos.order');

    // Video Category Routes
    Route::get('/video-categories', [VideoCategoryController::class, 'index'])->name('media.video_categories.index');
    Route::get('/video-categories/create', [VideoCategoryController::class, 'create'])->name('media.video_categories.create');
    Route::post('/video-categories', [VideoCategoryController::class, 'store'])->name('media.video_categories.store');
    Route::get('/video-categories/{video_category}/edit', [VideoCategoryController::class, 'edit'])->name('media.video_categories.edit');
    Route::put('/video-categories/{video_category}', [VideoCategoryController::class, 'update'])->name('media.video_categories.update');
    Route::delete('/video-categories/{video_category}', [VideoCategoryController::class, 'destroy'])->name('media.video_categories.destroy');
    Route::post('/video-categories/{video_category}/toggle', [VideoCategoryController::class, 'toggleStatus'])->name('media.video_categories.toggle');
    Route::post('/video-categories/order', [VideoCategoryController::class, 'updateOrder'])->name('media.video_categories.order');

    // Video Routes
    Route::get('/videos', [VideoController::class, 'index'])->name('media.videos.index');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('media.videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('media.videos.store');
    Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('media.videos.edit');
    Route::put('/videos/{video}', [VideoController::class, 'update'])->name('media.videos.update');
    Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('media.videos.destroy');
    Route::post('/videos/{video}/toggle', [VideoController::class, 'toggleStatus'])->name('media.videos.toggle');
    Route::post('/videos/order', [VideoController::class, 'updateOrder'])->name('media.videos.order');



});
