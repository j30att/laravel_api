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
        'sale_id',
        'response',
        'wallet_references_id',
        'p_p_request',
        'status',
        'error_code',
        'error_description',

    ];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }

    public function request(){
        return $this->belongsTo(PPRequest::class);
    }
}
