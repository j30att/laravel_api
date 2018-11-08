<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    const ROLE_USER         = 1;
    const ROLE_ADMIN        = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'birth_date',
        'country_id',
        'sms_subscribe',
        'email_subscribe',

    ];

    // use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bids(){
        return $this->hasMany(Bid::class,'user_id');
    }

    public function sales(){
        return $this->hasMany(Sale::class,'user_id');
    }

    public function  country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
}
