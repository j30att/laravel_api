<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable =[
        'sub_event_id',
        'title',
    ];

    public function subEvent(){
        return $this->belongsTo(SubEvent::class, 'sub_event_id');
    }
}
