<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");

        $customers = User::whereRelation('role', 'name', 'GUEST')
            ->with('role')
            ->get()
            ->toArray();
        
        $final_customers = [];

        foreach($customers as $row) 
            $final_customers[] = ['id' => $row['id'], 'caption' => $row['name']];

        $caption = array_column($final_customers, 'caption');
        array_multisort($caption, SORT_ASC, $final_customers);
        
        return Inertia::render('admin/Bookings', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'categories' => Activity::all('id', 'name as caption'),
            'customers' => $final_customers
        ]);
    }
}
