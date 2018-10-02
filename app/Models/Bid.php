<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    const BIDS_MATCHED    = 1;
    const BIDS_UNMATCHED  = 2;
    const BIDS_SETTLED    = 3;
    const BIDS_CANCELED   = 4;

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

}
