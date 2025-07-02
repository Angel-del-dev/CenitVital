<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    public function role_users() {
        return $this->hasMany(User::class, 'user_role_id', 'id');
    }
}
