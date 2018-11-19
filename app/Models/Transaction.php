<?php

namespace App\Models;
namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS_CREATED    = 1;
    const STATUS_SEND       = 2;
    const STATUS_SUCCESS    = 3;
    const STATUS_FAILED     = 4;

    const TYPE_BID_CREATED       = 1;
    const TYPE_BID_CANCELED     = 2;
    const TYPE_BID_CHANGED      = 3;
    const TYPE_PAY_REMAINING    = 4;
    const TYPE_BID_CLOSURE      = 5;

    protected $fillable =[
        'pp_bid_id',
        'bid_id',
        'sale_id',
        'user_id',
        'amount',
        'type',
        'status',
    ];
}
