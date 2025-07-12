<?php

namespace App\Http\Controllers;

use App\Http\Helpers\AdminMenu;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        $Activities = Activity::all()->toArray();
        return Inertia::render('admin/Activities/Activities', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'activities' => $Activities
        ]);
    }
}
