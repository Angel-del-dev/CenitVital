<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\guest\GuestDashboardController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    

    // Admin panel
    Route::get('{lang}/panel', [DashboardController::class, 'create']);
    // Guest panel
    Route::get('{lang}/my-place', [GuestDashboardController::class, 'create']);
       
});
