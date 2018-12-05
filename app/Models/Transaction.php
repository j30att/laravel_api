<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @property int $id
 * @property int $pp_bid_id
 * @property int $bid_id
 * @property int $sale_id
 * @property int $user_id
 * @property float $amount
 * @property float $balance
 * @property int $type
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PPBid $ppBid
 * @property Sale $sale
 * @property Event $event
 * @property SubEvent $subevent
 *
 * @property string $date
 * @property string $eventName
 * @property string $subeventName
 * @property bool $received
 * @property string $verbalStatus
 *
 * @package App\Models
 */
class Transaction extends Model
{
    const STATUS_CREATED = 1;
    const STATUS_SEND = 2;
    const STATUS_SUCCESS = 3;
    const STATUS_FAILED = 4;

    const TYPE_BID_CREATED = 1;
    const TYPE_BID_CANCELED = 2;
    const TYPE_BID_CHANGED = 3;
    const TYPE_PAY_REMAINING = 4;
    const TYPE_BID_CLOSURE = 5;
    const TYPE_BID_REWARDED = 6;

    protected $fillable = [
        'pp_bid_id',
        'bid_id',
        'sale_id',
        'user_id',
        'amount',
        'type',
        'status',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function event()
    {
        return $this->sale->event();
    }

    public function subevent()
    {
        return $this->sale->subevent();
    }

    public function ppBid()
    {
        return $this->hasOne(PPBid::class, 'pp_bid_id', 'pp_bid_id');
    }

    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d M');
    }

    public function getReceivedAttribute()
    {
        return $this->type === self::TYPE_BID_REWARDED;
    }

    public function getEventNameAttribute()
    {
        return $this->event->title;
    }

    public function getSubeventNameAttribute()
    {
        return $this->subevent->title;
    }

    public function getVerbalStatusAttribute()
    {
        if($this->status === self::STATUS_SEND || $this->status === self::STATUS_CREATED){
            return 'Pending';
        } elseif ($this->status === self::STATUS_SUCCESS){
            if($this->type !== self::TYPE_BID_REWARDED){
                return 'Sent';
            } else {
                return 'Received';
            }
        } else {
            return 'Error';
        }
    }
}
