<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Sale extends Model
{
    const SALE_ACTIVE  = 1;
    const SALE_CLOSED  = 2;

    const TYPE_IN_PROGRESS = 1;
    const TYPE_FULL = 2;

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
        'fill',
        'amount_raised',
        'share_sold',
        'average_markup',
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

    public function response(){
        return $this->hasMany(PPResponse::class, 'sale_id');
    }

    public function getPlacedAttribute(){
        $date_placed = Carbon::parse($this->created_at);
        $day = $date_placed->day;
        $month = $date_placed->shortEnglishMonth;
        $hour = $date_placed->hour;
        $minute = $date_placed->minute;

        return $month . ' ' . $day . ' , ' . $hour . ':' . $minute;

    }
    public function getTransactionCodeAttribute (){
        return (string)Str::uuid() . '-VERSION';
    }

    public function getTransactionInitiatedDateAttribute(){
        return Carbon::now()->timestamp;
    }

}





/*
    public function calculateBidsShare(){
        $shares = $this->bids;
        $shareSumm = 0;
        foreach ($shares as $share){

            $shareSumm += $share->share;

        }
        return $shareSumm;

    }

    public function  fillStatus(){
        $shareSumm = $this->calculateBidsShare;

        $self = Event::query()->get();
        if($shareSumm >=100){
            $self->fill = TYPE_FULL;
            $self->fill->save();
        } else{
            $self->fill = TYPE_IN_PROGRESS;
            $self->fill->save();
        }
    }


    public function calculateAmountRaise(){
        $raiseds = $this->bids_matched;
        $raisedSumm = 0;
        foreach ($raiseds as $raised){

            $raisedSumm += $raised->amount;

        }
        $this->amount_raised = $raisedSumm;
        $this->save();
        return number_format($this->amount_raised);

    }

    public function calculateAvarageMarkup(){
        $markups = $this->bids;

        $markupsSumm = 0;
        $markupsCount = $this->bids->count();
        //dd($markupsCount);

        foreach ($markups as $markup){
            $markupsSumm += $markup->markup;
        }
        if($markupsCount !=0){
            $averageMarkup = $markupsSumm / $markupsCount;
            return round($averageMarkup, 2) ;
        } else{
            return '0';
        }



    }$bid->amount*/


