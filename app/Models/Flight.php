<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    const TYPE_LIVE = 1;
    const TYPE_ONLINE = 2;

    protected $fillable =[
        'id',
        'event_id',
        'sub_event_id',
        'title',
        'type',
        'date',
        'flight',
        'day',
    ];

    public function subEvent(){
        return $this->belongsTo(SubEvent::class, 'sub_event_id');
    }
}
