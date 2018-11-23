<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 *
 * @property PPUser ppUser
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

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
        'image_id',
        'avatar'

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

    public function  avatar(){
        return $this->belongsTo(ImageAttachment::class, 'image_id');
    }

    public function ppUser(){
        return $this->hasOne(PPUser::class, 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    public function sendRegisterConfirmationNotification(){

        $this->notify(new \App\Notifications\UserRegisteredNotification($this));
    }


}
