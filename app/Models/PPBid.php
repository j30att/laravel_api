<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPBid extends Model
{
    protected $fillable =[
        'pp_bid_id',
        'sale_id',
        'status',
        'amount',
    ];
}
