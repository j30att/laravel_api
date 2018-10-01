<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    protected $fillable =[
        'event_id',
        'image_id',
        'title',
        'fund',
        'buy_in',
        'date_start',
        'date_end',
    ];


    public function flights(){
        return $this->hasMany(Flight::class, 'sub_event_id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'sub_event_id');
    }
}
