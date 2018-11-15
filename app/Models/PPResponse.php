<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPResponse extends Model
{
    const TYPE_PLACE_BID = 1;


    protected $fillable = [
        'type',
        'bid_id',
        'response'
    ];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }
}
