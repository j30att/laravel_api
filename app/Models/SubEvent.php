<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    protected $fillable =[
        'event_id',
        'image_id',
        'title',
        'fund',
        'buy_in',
        'date_start',
        'date_end',
    ];


    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function flights(){
        return $this->hasMany(Flight::class, 'sub_event_id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'sub_event_id');
    }




    public function getFormattedDateAttribute(){
        $start_date = Carbon::parse($this->date_start);

        $start_day = $start_date->day;
        $start_monty =$start_date->englishMonth;


        return $start_day . '  ' . $start_monty;
    }

    public function getFormattedShortDateAttribute(){
        $start_date = Carbon::parse($this->date_start);

        $start_day = $start_date->day;
        $start_monty =$start_date->shortEnglishMonth;


        return $start_day . '  ' . $start_monty;
    }
}

