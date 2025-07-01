<?php

use App\Http\Controllers\Base\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'Create'])->name('home');

require __DIR__.'/guest.php';
require __DIR__.'/auth.php';
