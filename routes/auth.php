<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Generic\BookingController;
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

    Route::get('{lang}/panel/customers', [UsersController::class, 'create_customer']);
    Route::get('{lang}/panel/customers/new', [UsersController::class, 'create_new_customer']);
    Route::get('{lang}/panel/customers/edit/{id}', [UsersController::class, 'modify_customer']);

    Route::post('/panel/user', [UsersController::class, 'store']);
    Route::put('/panel/user/{id}', [UsersController::class, 'update']);
    Route::delete('/panel/user/{id}', [UsersController::class, 'delete']);

    /* Admin Bookings */
    Route::get('{lang}/panel/bookings', [BookingController::class, 'create']);

    // Guest panel
    Route::get('{lang}/my-place', [GuestDashboardController::class, 'create']);
       
});
