<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Bid
 * @property int $id
 * @property int $user_id
 * @property int $sale_id
 * @property int $status
 * @property float $markup
 * @property float $share
 * @property float $amount
 * @property int $currency_id
 * @property int $outcome
 * @property int $p_p_bid_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $investor
 * @property Sale $sale
 * @property PPResponse $response
 * @property string $transaction_code
 * @property string $transaction_initiated_date

 *
 * @package App\Models
 */
class Bid extends Model
{
    const BID_NEW         = 1;
    const BIDS_MATCHED    = 2;
    const BIDS_UNMATCHED  = 3;
    const BIDS_SETTLED    = 4;
    const BIDS_CANCELED   = 5;

    const BID_PLACE             = 'BID_PLACE';
    const BID_CANCEL            = 'BID_CANCEL';
    const BID_PAY_REMAINING     = 'PAY_REMAINING';

    protected $fillable=[
        'user_id',
        'sale_id',
        'status',
        'markup',
        'share',
        'amount',
    ];

    public function investor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sale(){
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function response(){
        return $this->hasMany(PPRequest::class, 'bid_id');
    }

    public function getTransactionCodeAttribute (){
        return (string)Str::uuid() . '-VERSION';
    }

    public function getTransactionInitiatedDateAttribute(){
        return Carbon::now()->timestamp;
    }



}
