<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 17.10.18
 * Time: 17:15
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\PPBid;
use App\Models\PPRequest;
use App\Models\Result;
use App\Models\Sale;
use App\Models\Transaction;
use function Couchbase\defaultDecoder;

class ManageService
{

    public static function linkBidToSale(Bid $bid)
    {
        try {
            $sale = $bid->sale;

            if (self::equationLinkBids($bid, $sale)) {
                $bid->status = Bid::BIDS_MATCHED;
                $bid->save();

                self::calcAmountRaised($sale);
                self::calcShareSold($sale);
                self::calcAvgMarkup($sale);
                self::calcClose($sale);
            } else {
                $bid->status = Bid::BIDS_UNMATCHED;
                $bid->save();
            };

            return $bid;
        } catch (\Exception $e) {
            return response()->json(['status' => 1, 'msg' => 'link bid to sale failure']);
        }
    }

    public static function equationLinkBids(Bid $bid, Sale $sale)
    {
        if ($sale->share == $bid->share
            && $sale->markup == $bid->markup
            && $sale->amount == $bid->amount) {
            return true;
        }

        return false;
    }


    public static function manageWins(Result $result)
    {
        $sale = Sale::query()->with('bids')->find($result->sale_id);
        $money = $result->prize * ($sale->share / 100);
        ManageService::calculateWinners($sale->bids, $money);
    }

    private static function calculateWinners($bids, $money)
    {
        foreach ($bids as $bid) {
            $bisPrize = $money * ($bid->share) / 100;
            $bid->outcome = $bisPrize;
            $bid->status = Bid::BIDS_SETTLED;
            $bid->save();
        }
    }

    public static function calcAmountRaised(Sale $sale)
    {
        $bidsMatched = $sale->bids_matched;
        $event = $sale->event;

        $amount_raised = 0;
        foreach ($bidsMatched as $bid) {
            $amount_raised += ($bid->amount / $bid->markup);
        }

        $sale->amount_raised = $amount_raised;
        if ($amount_raised < $event->buy_in) {
            $sale->save();
        }

    }

    public static function calcClose(Sale $sale)
    {
        $bidsMatched = $sale->bids_matched;
        $event = $sale->event;

        $amount_raised = 0;
        foreach ($bidsMatched as $bid) {
            $amount_raised += ($bid->amount / $bid->markup);
        }

        if ($amount_raised >= $event->buy_in) {
            $sale->status = Sale::SALE_CLOSED;
            $sale->fill_status = 1;
            $sale->save();
        }

    }


    public static function calcAvgMarkup(Sale $sale)
    {
        $bids = $sale->bids;
        $count = count($bids);
        $avgMarkup = 0;
        foreach ($bids as $bid) {
            $avgMarkup = $bid->markup;
        }
        $avgMarkup = $count ? $avgMarkup / $count : 0;
        $sale->average_markup = $avgMarkup;
        $sale->save();
    }

    public static function calcShareSold(Sale $sale)
    {
        $event = $sale->event;
        $percent = $event->buy_in / 100;
        $percentage = $sale->amount_raised / $percent;
        $sale->share_sold = $percentage;
        $sale->save();
    }

    public static function calcRemaining(Sale $sale)
    {
        return ((integer)($sale->event->buy_in * 100) - (integer)($sale->amount_raised * 100)) / 100;
    }

    public static function payRemaining(Sale $sale)
    {
        $remaining = self::calcRemaining($sale);

        self::calcAmountRaised($sale);
        self::calcAvgMarkup($sale);
        self::calcShareSold($sale);

        $transaction = new Transaction();
        $transaction->bid_id = null;
        $transaction->sale_id = $sale->id;
        $transaction->user_id = $sale->user_id;
        $transaction->amount = $remaining;
        $transaction->type = Transaction::TYPE_PAY_REMAINING;
        $transaction->save();

        $pp_bid_id = PPInteraction::payRemaining($sale, $remaining);
        if ($pp_bid_id) {
            $PPBid = new PPBid();
            $PPBid->pp_bid_id = $pp_bid_id;
            $PPBid->sale_id = $sale->id;
            $PPBid->status = PPRequest::TYPE_BID_REMAINING;
            $PPBid->amount = $remaining;
            $PPBid->save();

            $sale->status = Sale::SALE_CLOSED;
            $sale->fill_status = 1;
            $sale->save();

            $transaction->update([
                'status' => Transaction::STATUS_SUCCESS,
                'pp_bid_id' => $PPBid->pp_bid_id
            ]);
        } else {
            $transaction->update(['status' => Transaction::STATUS_FAILED]);
        }
    }

    public static function sendBidToAPI(Bid $bid)
    {
        /** @var Transaction $transactionExist */
        $transactionExist = Transaction::query()
            ->where('sale_id', $bid->sale_id)
            ->where('user_id', $bid->user_id)
            ->where('status', Transaction::STATUS_SUCCESS)
            ->whereHas('ppBid')
            ->first();

        if ($transactionExist && $transactionExist->ppBid) {
            $transaction = self::createTransaction($bid, Transaction::TYPE_BID_CHANGED);
            $ppBid = PPInteraction::bidChange($bid, $transactionExist->ppBid);
        } else {
            $transaction = self::createTransaction($bid, Transaction::TYPE_BID_CREATED);
            $ppBid = PPInteraction::bidPlace($bid);
        }

        if($ppBid){
            self::updateTransaction($transaction, $ppBid);

            $bid->status = Bid::BIDS_MATCHED;
            $bid->p_p_bid_id = $ppBid->pp_bid_id;
            $bid->save();

            /** @var Sale $sale */
            $sale = Sale::query()->find($bid->sale_id);
            $sale->markup = $bid->markup;
            $sale->share = $bid->share;
            $sale->amount= $bid->amount;
            $sale->save();

            self::calcAmountRaised($sale);
            self::calcShareSold($sale);
            self::calcAvgMarkup($sale);
            self::calcClose($sale);
        }

    }

    public static function createTransaction(Bid $bid, $type)
    {
        $transaction = new Transaction();

        $transaction->bid_id = $bid->id;
        $transaction->sale_id = $bid->sale_id;
        $transaction->user_id = $bid->user_id;
        $transaction->amount = $bid->amount;
        $transaction->type = $type;

        if ($bid->p_p_bid_id) {
            $transaction->pp_bid_id = $bid->p_p_bid_id;
        }

        if ($transaction->save()) {
            return $transaction;
        }

        return false;
    }

    private static function updateTransaction(Transaction $transaction, $ppBid)
    {
        if ($ppBid) {
            $transaction->update([
                'pp_bid_id' => $ppBid->pp_bid_id,
                'status' => Transaction::STATUS_SUCCESS
            ]);
        } else {
            $transaction->update(['status' => Transaction::STATUS_FAILED]);
        }
    }
}
