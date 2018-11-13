<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPUser extends Model
{
    protected $table = 'pp_users';

    protected $fillable=[
        'user_id',
        'first_name',
        'last_name',
        'result',
        'account_id',
        'screen_name',
        'funded',
        'session',
    ];


}
