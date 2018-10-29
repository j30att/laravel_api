<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 17.10.18
 * Time: 17:15
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\Sale;

class BetsManageService
{

    public static function linkBidToSale(Bid $bid)
    {
        $sale = Sale::find($bid->sale_id);

        if (self::equationLinkBids($bid, $sale)) {
            $bid->status = Bid::BIDS_MATCHED;
        } else {
            $bid->status = Bid::BIDS_UNMATCHED;
        };

        $bid->save();
        return $bid;
    }

    private static function equationLinkBids(Bid $bid, Sale $sale)
    {
        if ($sale->share == $bid->share && $sale->markup == $bid->markup && $sale->amount == $bid->amount) return true;
        return false;
    }




}
