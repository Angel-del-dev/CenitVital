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
        $Activities = Activity::all('id as value', 'name as caption')->toArray();
        array_unshift($Activities, ['value' => '', 'caption' => '']);

        array_unshift($final_customers, ['value' => '', 'caption' => '']);
        return Inertia::render('admin/Bookings', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'categories' => $Activities,
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
        $request = $req->all();
        Events::where('id', '=', $id)
            ->update([
                'date' => $request['date'].' '.$request['timestart'],
                'user_id' => $request['customer'],
                'activities_id' => $request['activity'],
                'subject' => $request['subject'],
                'observation' => $request['observation']
            ]);
        return response([], 200);
    }

    public function delete(int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        Events::where('id', '=', $id)
            ->delete();
        return response([], 200);
    }

    public function get_info(int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        $evt = Events::where('id', '=', $id)
            ->first()
            ->toArray();
        return response(['Info' => $evt], 200);
    }
}
