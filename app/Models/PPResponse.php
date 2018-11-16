<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPResponse extends Model
{
    const TYPE_PLACE_BID        = 1;
    const TYPE_BID_CHANGE       = 2;
    const TYPE_BID_CANCEL       = 3;
    const TYPE_BID_CLOSURE      = 4;
    const TYPE_BID_REMAINING    = 5;


    protected $fillable = [
        'type',
        'bid_id',
        'response',
        'wallet_references_id'
    ];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }
}
