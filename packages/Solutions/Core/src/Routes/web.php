<?php 
// packages/solutions/core/routes/web.php

use Illuminate\Support\Facades\Route;
use Solutions\Core\Http\Controllers\DashboardController;

Route::prefix('cp')->as('cp.')->middleware(['web', 'auth'])->group(function(){
  Route::get('/', [DashboardController::class , 'index']);
});