<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = [
        'name',
        'code',
        'slug',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
