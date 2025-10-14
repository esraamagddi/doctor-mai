<?php

use Illuminate\Support\Facades\Route;
use Solutions\SiteSetting\Http\Controllers\SiteSettingController;

Route::prefix('cp')->name('sitesetting.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/sitesetting', [SiteSettingController::class, 'edit'])->name('edit')->middleware('perm:sitesetting.view');
    Route::put('/sitesetting', [SiteSettingController::class, 'update'])->name('update')->middleware('perm:sitesetting.view'); // edit permission
    Route::get('/sitesetting/index', fn() => redirect()->route('sitesetting.edit'))->name('index');
});
