<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        $users = User::whereRelation('role', 'name', 'ADMIN')
            ->with('role')
            ->get();
        $final_users = [];
        foreach($users as $user) {
            $final_users[] = [$user->id, $user->name];
        }    
        return Inertia::render('admin/Users',[
            'lang' => $lang,
            'users' => $final_users,
            'menu' => new AdminMenu()->GetMenu($lang)
        ]);
    }

    public function create_new(string $lang) {
        return Inertia::render('admin/User',[
            'lang' => $lang,
            'user' => ['user_role_id' => 1],
            'menu' => new AdminMenu()->GetMenu($lang),
            'creation' => true
        ]);
    }

    public function modify(string $lang, int $id) {
        $user = User::where('id', '=', $id)
            ->first()
            ->toArray();
        return Inertia::render('admin/User',[
            'lang' => $lang,
            'user' => $user,
            'menu' => new AdminMenu()->GetMenu($lang),
            'creation' => false
        ]);
    }

    public function store(Request $request) {
        $user = $request->all();
        $user_count = User::where('email', '=', $user['email'])->count();
        if($user_count > 0) return response(['message' => 'user_exists'], 400);
        $user['password'] = Hash::make($user['password'] ?? '');
        User::create($user);
        return response([], 200);
    }

    public function update(Request $request, int $id) {
        $user = $request->all();
        unset($user['created_at'], $user['updated_at']);
       
        if(isset($user['password'])) {
            if($user['password'] === '') unset($user['password']);
            else $user['password'] = Hash::make($user['password']);
        }

        
        User::where('id', '=', $id)
            ->update($user);
        return response([], 200);
    }

    public function delete(int $id) {
        User::where('id', '=', $id)
            ->delete();
        
        return response([], 200);
    }
}
