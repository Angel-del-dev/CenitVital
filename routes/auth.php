<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backoffice\Creations;
use App\Http\Controllers\Backoffice\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('backoffice', [HomeController::class, 'Create'])
        ->name('backoffice-home');
    Route::get('backoffice/creations', [Creations::class, 'create'])
        ->name('backoffice-creations');
});
