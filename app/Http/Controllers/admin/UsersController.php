<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Models\User;

use Inertia\Inertia;

class UsersController extends Controller
{
    public function create(string $lang) {
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
}
