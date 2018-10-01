<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    const SALE_ACTIVE  = 1;
    const SALE_CLOSED  = 2;
    const SALE_MARKUP  = 3;

    protected $fillable=[
        'user_id',
        'sub_event_id',
        'flight_id',
        'status',
        'markup',
        'amount',
        'share',

    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids(){
        return $this->belongsToMany(Bid::class,'bid_id');
    }

    public function subevent(){
        return $this->belongsTo(SubEvent::class,'sub_event_id');
    }
}
