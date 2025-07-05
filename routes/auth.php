<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\guest\GuestDashboardController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    

    // Admin panel
    Route::get('{lang}/panel', [DashboardController::class, 'create']);
    Route::get('{lang}/panel/users', [UsersController::class, 'create']);
    Route::get('{lang}/panel/users/new', [UsersController::class, 'create_new']);
    Route::get('{lang}/panel/users/edit/{id}', [UsersController::class, 'modify']);
    Route::post('/panel/user', [UsersController::class, 'store']);
    Route::put('/panel/user/{id}', [UsersController::class, 'update']);
    // Guest panel
    Route::get('{lang}/my-place', [GuestDashboardController::class, 'create']);
       
});
