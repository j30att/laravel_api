<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class UserConfirmations extends Model
{
    const SALT =  'FzLZujgRXLwHMZSQrXHdjjnsVUf8rUYww2UvUrXt';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->token = hash('md5', microtime() . self::SALT);
        $this->expired_date = Carbon::now()->addHours(2);
    }

    protected $fillable =[
        'email',
        'token',
        'expired_date',
    ];

    public function getConfirmationUrlAttribute(){
        return config::get('app.url') . '/?confirmationToken='.$this->token;
    }
}
