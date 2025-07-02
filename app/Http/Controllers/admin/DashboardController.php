<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use Inertia\Inertia;


class DashboardController extends Controller
{
    public function create(string $lang) {
        return Inertia::render('admin/Dashboard', [
            'lang' => $lang, 
            'menu' => new AdminMenu()->GetMenu($lang)
        ]);
    }
}
