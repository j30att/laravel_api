<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;



class Event extends Model
{
    const LIMIT_EVENT_MAIN_PAGE         = 6;

    protected $fillable = [
        'title',
        'image_id',
        'fund',
        'buy_in',
        'reg_free',
        'date_start',
        'date_end',


        'slug',
        'logo',

        'country_id',

        'event_time_zone',
        'event_venue_address_str',
        'first_live_day',
        'last_live_day',
        'first_day_date',
        'last_day_date',
        'start_date_time',
        'late_reg',
        'time_zone',
        'currency',



    ];

    public function subEvents()
    {
        return $this->hasMany(SubEvent::class, 'event_id');
    }

    public function flights()
    {
        return $this->hasMany(Flight::class, 'event_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'event_id');
    }

    public function  country(){
        return $this->belongsTo(Country::class, 'country_id');
    }


    public function getFormattedDateAttribute()
    {
        $start_date = Carbon::parse($this->date_start);
        $start_date = $start_date->day;
        $end_date = Carbon::parse($this->date_end);
        $end_month = $end_date->shortEnglishMonth;
        $end_eyar = $end_date->year;
        $end_date = $end_date->day;

        return $start_date . ' - ' . $end_date . ' ' . $end_month . ' ' . $end_eyar;
    }

    public function getFormattedStartDateAttribute()
    {
        $date = Carbon::parse($this->date_start);
        $day = $date->day;
        $month = $date->englishMonth;
        return $day . ' ' . $month;
    }

    public function getFormattedEndDateAttribute()
    {
        $date = Carbon::parse($this->date_end);
        $day = $date->day;
        $month = $date->englishMonth;
        return $day . ' ' . $month;
    }

    public function getPeriodAttribute()
    {
        $date_start = Carbon::parse($this->date_start);
        $date_end = Carbon::parse($this->date_end);
        return $date_start->format('M d') . ' – ' . $date_end->format('M d');
    }

    public function getCloseInAttribute()
    {
        $date_end = Carbon::parse($this->date_end);
        $dateCurrent = Carbon::now();
        if ($date_end->gt($dateCurrent)){
            return date_diff($date_end, $dateCurrent)->days . ' ' . 'days';
        } else {
            return 'Close';
        }
    }




}
