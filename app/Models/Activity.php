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
}
