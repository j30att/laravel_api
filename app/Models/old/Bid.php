<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    const STATUS_MATCHED    = 1;
    const STATUS_UNMATCHED  = 2;
    const STATUS_SETTLED    = 3;
    const STATUS_CANCELED   = 4;

    protected $fillable=[
        'subevent_id',
        'creator_id',
        'price_part',
        'percent',
    ];

    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function subevent(){
        return $this->belongsTo(SubEvent::class, 'subevent_id');
    }

    public function bidResponse(){
        return $this->hasMany(BidResponse::class, 'bid_id');
    }



}
