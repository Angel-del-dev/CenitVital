<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'date',
        'user_id',
        'activities_id',
        'subject',
        'observation'
    ];

    public function activity() {
       return $this->belongsTo(Activity::class, 'activities_id', 'id'); 
    }

    public function user() {
       return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
