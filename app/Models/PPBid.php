<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PPBid
 * @property int $id
 * @property int $pp_bid_id
 * @property int $sale_id
 * @property int $status
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Bid[] $bids
 * @property Transaction[] $transactions
 *
 * @package App\Models
 */
class PPBid extends Model
{
    protected $fillable = [
        'pp_bid_id',
        'sale_id',
        'status',
        'amount',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class, 'p_p_bid_id', 'pp_bid_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'pp_bid_id', 'pp_bid_id');
    }
}
