<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class DashboardController extends Controller
{
    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        return Inertia::render('admin/Dashboard', [
            'lang' => $lang, 
            'menu' => new AdminMenu()->GetMenu($lang)
        ]);
    }
}
