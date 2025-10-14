<?php

use Illuminate\Support\Facades\Route;
use Solutions\Blog\Http\Controllers\PostController;
use Solutions\Blog\Http\Controllers\CategoryController;

Route::prefix('cp/blog')->middleware(['web', 'auth'])->group(function () {

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('blog.categories.index')->middleware('perm:blog.categories.view');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('blog.categories.create')->middleware('perm:blog.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('blog.categories.store')->middleware('perm:blog.categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('blog.categories.edit')->middleware('perm:blog.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('blog.categories.update')->middleware('perm:blog.categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('blog.categories.destroy')->middleware('perm:blog.categories.delete');
    Route::post('/categories/{category}/toggle', [CategoryController::class, 'toggleStatus'])->name('blog.categories.toggle')->middleware('perm:blog.categories.toggle');
    Route::post('/categories/order', [CategoryController::class, 'updateOrder'])->name('blog.categories.order')->middleware('perm:blog.categories.order');
    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('blog.posts.index')->middleware('perm:blog.posts.view');
    Route::get('/posts/create', [PostController::class, 'create'])->name('blog.posts.create')->middleware('perm:blog.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('blog.posts.store')->middleware('perm:blog.posts.create');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('blog.posts.edit')->middleware('perm:blog.posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('blog.posts.update')->middleware('perm:blog.posts.edit');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('blog.posts.destroy')->middleware('perm:blog.posts.delete');
    Route::post('/posts/{post}/toggle', [PostController::class, 'toggleStatus'])->name('blog.posts.toggle')->middleware('perm:blog.posts.toggle');
    Route::post('/posts/order', [PostController::class, 'updateOrder'])->name('blog.posts.order')->middleware('perm:blog.posts.order');
});
