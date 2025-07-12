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
        $Activities = Activity::all('id', 'name')->toArray();
        return Inertia::render('admin/Activities/Activities', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'activities' => $Activities
        ]);
    }

    public function create_new(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        return Inertia::render('admin/Activities/Activity', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'is_new' => true
        ]);
    }
    public function modify(string $lang, int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");

        return Inertia::render('admin/Activities/Activity', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'is_new' => false,
            'category' => Activity::where('id', '=', $id)->first()
        ]);
    }

    public function store(Request $req) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        $Activity = $req->all();

        $exists = Activity::where('name', '=', $Activity['name'])
            ->count() > 0;
        
        if($exists) return response(['message' => 'category_exists'], 400);

        Activity::create([
            'name' => $Activity['name'],
            'duration' => $Activity['duration'],
            'color' => $Activity['color'],
            'observation' => $Activity['observation']
        ]);
        return response([], 200);
    }

    public function update(Request $req, int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);
        $Activity = $req->all();
        
        Activity::where('id', '=', $id)
            ->update($Activity);
        return response([], 200);
    }

    public function delete(int $id) {
        if(Auth::user()->role->name !== 'ADMIN') return response([], 404);        
        Activity::where('id', '=', $id)
            ->delete();
        return response([], 200);
    }
}
