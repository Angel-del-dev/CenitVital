<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'duration',
        'color',
        'observation'
    ];

    public function events() {
        return $this->hasMany(Events::class, 'activities_id', 'id');
    }
}
