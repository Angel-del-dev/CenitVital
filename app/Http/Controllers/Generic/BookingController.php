<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        return Inertia::render('admin/Bookings', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'categories' => Activity::all('id', 'name as caption')
        ]);
    }
}
