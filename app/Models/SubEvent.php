<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    protected $fillable=[
        'event_id',
        'title',
        'image_id',
        'fund',
        'date_start',
        'date_end'
    ];

    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}
