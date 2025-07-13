<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Models\Activity;
use App\Models\Events;
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
            $final_customers[] = ['value' => $row['id'], 'caption' => $row['name']];

        $caption = array_column($final_customers, 'caption');
        array_multisort($caption, SORT_DESC, $final_customers);

        $events = [];

        $evt = Events::with('activity')
            ->get()
            ->toArray();
        foreach($evt as $row) {
            $events[] = [
                'id' => $row['id'],
                'title' => $row['subject'],
                'date' => str_replace(' ', 'T', $row['date']),
                'color' => '#'.$row['activity']['color']
            ];
        }

        // dd($events);

        return Inertia::render('admin/Bookings', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'categories' => Activity::all('id as value', 'name as caption'),
            'customers' => $final_customers,
            'events' => $events
        ]);
    }

    public function store(Request $req) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        $request = $req->all();
        Events::create([
            'date' => $request['date'].' '.$request['timestart'],
            'user_id' => $request['customer'],
            'activities_id' => $request['activity'],
            'subject' => $request['subject'],
            'observation' => $request['observation']
        ]);
        return response([], 200);
    }

    public function update(Request $req, int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        dd($req->all());
    }

    public function delete(int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        dd($id);
    }
}
