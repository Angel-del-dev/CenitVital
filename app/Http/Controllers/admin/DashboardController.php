<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function create(string $lang) {
        return Inertia::render('admin/Dashboard', ['lang' => $lang]);
    }
}
