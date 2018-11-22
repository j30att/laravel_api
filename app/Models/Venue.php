<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable =[
        'event_id',
        'country_id',
        'title',
        'adress_type',
        'street',
        'locality',
        'postal_code',
        'address_region',
        'venue_address',
        'venue_longitude',
        'venue_latitude',
    ];


    public function events()
    {
        return $this->hasMany(Event::class, 'venue_id');
    }

}
