<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BidResponse extends Model
{

    const BIDS_RESPONSE_MATCHED    = 1;
    const BIDS_RESPONSE_UNMATCHED  = 2;
    const BIDS_RESPONSE_SETTLED    = 3;
    const BIDS_RESPONSE_CANCELED   = 4;

    protected $fillable=[
        'status',
        'bid_id',
        'investor_id',
        'subevent_id',
        'value',
        'income',
    ];

    public function investor(){
        return $this->belongsTo(User::class, 'investor_id');
    }

    public function bid(){
        return $this->belongsTo(Bid::class,'bid_id');
    }

    public function subevent(){
        return $this->belongsTo(SubEvent::class,'subevent_id');
    }


}
