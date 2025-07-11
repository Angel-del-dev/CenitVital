<?php

use App\Http\Controllers\Base\LandingController;
use App\Http\Controllers\Base\LangsController;
use Illuminate\Support\Facades\Route;

Route::get('/utils/translations/{desired_lang}/{desired_section}', [LangsController::class, 'Get'])->name('GetLangs');

if(env('APP_LANDING', false)) {
    Route::fallback([LandingController::class, 'Redirect'])->name('LandingRedirect');
    Route::get('{lang}/landing', [LandingController::class, 'Create'])->name('landing');
}

require __DIR__.'/guest.php';
require __DIR__.'/auth.php';

