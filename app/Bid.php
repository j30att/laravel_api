<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    const STATUS_MATCHED    = 1;
    const STATUS_UNMATCHED  = 2;
    const STATUS_SETTLED    = 3;
    const STATUS_CANCELED   = 4;

    protected $fillable=[

    ];
}
