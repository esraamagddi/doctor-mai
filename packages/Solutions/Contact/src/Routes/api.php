<?php

use Illuminate\Support\Facades\Route;
use Solutions\Contact\Http\Controllers\Front\ContactSubmitController;

Route::middleware(['api'])
    ->post('/contact', [ContactSubmitController::class, 'store'])
    ->name('contact.submit');
