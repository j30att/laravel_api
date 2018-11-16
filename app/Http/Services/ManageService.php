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

class ManageService
{

    public static function linkBidToSale(Bid $bid)
    {
        try {
            $sale = $bid->sale;

            if (self::equationLinkBids($bid, $sale)) {
                $bid->status = Bid::BIDS_MATCHED;
                self::calcAmountRaised($sale);
                self::calcShareSold($sale);
                self::calcAvgMarkup($sale);
            } else {
                $bid->status = Bid::BIDS_UNMATCHED;
            };

            $bid->save();
            return $bid;
        } catch (\Exception $e){
            return response()->json(['status'=>1, 'msg'=>'link bid to sale failure']);
        }
    }

    private static function equationLinkBids(Bid $bid, Sale $sale)
    {
        if ($sale->share == $bid->share && $sale->markup == $bid->markup && $sale->amount == $bid->amount) return true;
        return false;
    }


    public static function manageWins(Result $result){
        $sale = Sale::query()->with('bids')->find($result->sale_id);
        $money = $result->prize * ($sale->share/100);
        ManageService::calculateWinners($sale->bids, $money);
    }

    private static function calculateWinners($bids, $money){
        foreach ($bids as $bid){
            $bisPrize = $money * ($bid->share)/100;
            $bid->outcome = $bisPrize;
            $bid->status = Bid::BIDS_SETTLED;
            $bid->save();
        }
    }

    private static function calcAmountRaised(Sale $sale){
        $bidsMatched = $sale->bids_matched;
        $event = $sale->event;

        $amount_raised = 0;
        foreach ($bidsMatched as $bid){
            $amount_raised += ($bid->amount / $bid->markup);

        }
        $sale->amount_raised = $amount_raised;
        if ($amount_raised < $event->buy_in){
            $sale->save();
        }

    }


    private static function calcAvgMarkup(Sale $sale){
        $bids = $sale->bids;
        $count = count($bids);
        $avgMarkup = 0;
        foreach ($bids as $bid){
            $avgMarkup = $bid->markup;
        }
        $avgMarkup = $avgMarkup / $count;
        $sale->average_markup = $avgMarkup;
        $sale->save();
    }

    private static function calcShareSold (Sale $sale){
        $event = $sale->event;
        $percent = $event->buy_in / 100;
        $percentage = $sale->amount_raised / $percent;
        $sale->share_sold = $percentage;
        $sale->save();
    }

    public static function calcRemaining(Sale $sale){
        return ((integer)($sale->event->buy_in * 100) - (integer)($sale->amount_raised*100))/100;
    }

}
