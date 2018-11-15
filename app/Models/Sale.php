<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sale extends Model
{
    const SALE_ACTIVE  = 1;
    const SALE_CLOSED  = 2;

    const TYPE_FULL = 1;
    const TYPE_IN_PROGRESS = 2;

    protected $fillable=[
        'user_id',
        'event_id',
        'sub_event_id',
        'buy_in',
        'flight_id',
        'status',
        'markup',
        'amount',
        'share',
        'created_at',
        'fill'

    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bids(){
        return $this->hasMany(Bid::class,'sale_id');
    }

    public function bids_matched(){
        return $this->hasMany(Bid::class,'sale_id')->where('status', Bid::BIDS_MATCHED);
    }
    public function bids_unmatched(){
        return $this->hasMany(Bid::class,'sale_id')->where('status', Bid::BIDS_UNMATCHED);
    }
    public function bids_highest(){
        return $this->hasMany(Bid::class,'sale_id')
                    ->where('status', Bid::BIDS_UNMATCHED)
                    ->orderBy('share', 'desc')->limit(3);

    }
    public function subevent(){
        return $this->belongsTo(SubEvent::class,'sub_event_id');
    }
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }

    public function getPlacedAttribute(){
        $date_placed = Carbon::parse($this->created_at);
        $day = $date_placed->day;
        $month = $date_placed->shortEnglishMonth;
        $hour = $date_placed->hour;
        $minute = $date_placed->minute;

        return $month . ' ' . $day . ' , ' . $hour . ':' . $minute;

    }



}
