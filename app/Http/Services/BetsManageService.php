<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 17.10.18
 * Time: 17:15
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\Result;
use App\Models\Sale;
use function Couchbase\defaultDecoder;

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


    public static function manageWins(Result $result){
        $sale = Sale::query()->with('bids')->find($result->sale_id);
        $money = $result->prize * ($sale->share/100);
        BetsManageService::calculateWinners($sale->bids, $money);
    }


    private static function calculateWinners($bids, $money){
        foreach ($bids as $bid){
            $bisPrize = $money * ($bid->share)/100;
            $bid->outcome = $bisPrize;
            $bid->status = Bid::BIDS_SETTLED;
            $bid->save();
        }
    }



}
