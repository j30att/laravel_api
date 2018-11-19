<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPRequest extends Model
{
    const TYPE_PLACE_BID        = 1;
    const TYPE_BID_CHANGE       = 2;
    const TYPE_BID_CANCEL       = 3;
    const TYPE_BID_CLOSURE      = 4;
    const TYPE_BID_REMAINING    = 5;

    protected $fillable =[
        'bid_id',
        'sale_id',
        'transaction_type',
        'amount',
        'headers',
        'body',
    ];

    public function response (){
        return $this->hasOne(PPResponse::class,'p_p_request');
    }
}
