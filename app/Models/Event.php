<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * @property int $id
 * @property int $country_id
 * @property string $title
 * @property string $description
 * @property float $buy_in
 * @property float $reg_free
 * @property float $fund
 * @property string $slug
 * @property string $logo
 * @property string $currency
 * @property int $venue_id
 * @property string $venue_name
 * @property string $date_start
 * @property string $date_end
 * @property string $created_at
 * @property string $updated_at
 * @property int $currency_id
 * @property int $status
 *
 * @property Sale[] $sales
 * @property SubEvent[] $sub_events
 *
 * @package App\Models
 */
class Event extends Model
{
    const LIMIT_EVENT_MAIN_PAGE     = 6;

    const STATUS_ACTIVE             = 1;
    const STATUS_CLOSED             = 2;

    protected $fillable = [
        'id',
        'country_id',
        'title',
        'description',
        'buy_in',
        'reg_free',
        'fund',
        'slug',
        'logo',
        'currency',
        'venue_id',
        'venue_name',
        'date_start',
        'date_end',
        'image_id'
    ];

    public function image(){
        return $this->belongsTo(ImageAttachment::class,'image_id');
    }
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
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

    public function getMainImageAttribute(){
        return 'https://res.cloudinary.com/partypoker-live/image/upload/'.$this->logo;
    }



}
