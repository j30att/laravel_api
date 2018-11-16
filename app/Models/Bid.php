<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bid extends Model
{
    const BID_NEW         = 1;
    const BIDS_MATCHED    = 2;
    const BIDS_UNMATCHED  = 3;
    const BIDS_SETTLED    = 4;
    const BIDS_CANCELED   = 5;

    const BID_PLACE             = 'BID_PLACE';
    const BID_CANCEL            = 'BID_CANCEL';
    const BID_PAY_REMAINING     = 'BID_PAY_REMAINING';

    protected $fillable=[
        'user_id',
        'sale_id',
        'status',
        'markup',
        'share',
        'amount',
    ];

    public function investor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function geTransactionCodeAttribute (){
        return ((string)Str::uuid() . '-VERSION');
    }

    public function getTransactionInitiatedDateAttribute(){
        return Carbon::now()->timestamp;
    }

}
