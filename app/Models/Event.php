<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
        'title',
        'image_id',
        'fund',
        'date_start',
        'date_end'
    ];

    public function subevents(){
        return $this->hasMany(SubEvent::class,'event_id');
    }



    public function getFormattedDataAttribute(){
        $start_date = Carbon::parse($this->date_start);
        $start_date =$start_date->day;
        $end_date = Carbon::parse($this->date_end);
        $end_month =$end_date->shortEnglishMonth;
        $end_date = $end_date->day;
        return $start_date . ' - ' . $end_date . ' ' . $end_month;
    }


}
