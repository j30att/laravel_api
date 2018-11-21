<?php

namespace App\Console\Commands;

use App\Http\Services\ManageService;
use App\Http\Services\PPInteraction;
use App\Models\Bid;
use App\Models\Event;
use App\Models\PPBid;
use App\Models\PPRequest;
use App\Models\PPResponse;
use App\Models\Sale;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpParser\ErrorHandler\Collecting;

class CheckEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        /** @var Event[] $events */
        $events = Event::query()
            ->where('status', Event::STATUS_ACTIVE)
            ->whereDate('date_start', '<=', Carbon::now()->toDateString())
            ->with('sales')
            ->get();

        foreach ($events as $event) {
            foreach ($event->sales as $sale) {

                $ppBids = PPBid::query()
                    ->where('sale_id', $sale->id)
                    ->with('bids')
                    ->get();

                if ($ppBids) {
                    if ($sale->fill_status) {
                        self::ppBidsClosure($ppBids);
                    } else {
                        self::ppBidsCancel($ppBids);
                        $sale->update(['status' => Sale::SALE_CLOSED]);
                        $sale->bids()->update(['status' => Bid::BIDS_CANCELED]);
                    }
                }
            }
            $event->update(['status' => Event::STATUS_CLOSED]);
        }
    }


    private function ppBidsClosure(Collection $ppBids)
    {
        $transactionsId = [];
        $ppBidsCodes = $ppBids->pluck('pp_bid_id')->toArray();

        foreach ($ppBids as $ppBid) {
            if ($ppBid->bids) {
                foreach ($ppBid->bids as $bid) {
                    if ($bid->status == Bid::BIDS_MATCHED) {
                        $transaction = ManageService::createTransaction($bid, Transaction::TYPE_BID_CLOSURE);
                        $transactionsId[] = $transaction->id;
                    }
                }
            }
        }

        $statuses = PPInteraction::bidClosure($ppBidsCodes);
        if ($statuses) {
            foreach ($statuses as $ppBidId => $status) {
                /** @var PPBid $ppBid */
                $ppBid = PPBid::query()
                    ->with('bids')
                    ->where('pp_bid_id', $ppBidId)
                    ->first();
                if ($ppBid && $status == 'SUCCESS') {
                    if ($ppBid->bids) {
                        $ppBid->bids()
                            ->where('status', Bid::BIDS_MATCHED)
                            ->update(['status' => Bid::BIDS_SETTLED]);
                        $ppBid->bids()
                            ->where('status', Bid::BIDS_UNMATCHED)
                            ->update(['status' => Bid::BIDS_CANCELED]);
                    }
                    $ppBid->update(['status' => PPBid::TYPE_CLOSURE]);
                    $ppBid->transactions()
                        ->whereIn('id', $transactionsId)
                        ->update(['status' => Transaction::STATUS_SUCCESS]);
                } else {
                    PPInteraction::bidCancel($ppBid);
                    $ppBid->update(['status' => PPBid::TYPE_ERROR]);
                    $ppBid->transactions()
                        ->whereIn('id', $transactionsId)
                        ->update(['status' => Transaction::STATUS_FAILED]);
                    $ppBid->bids()
                        ->update(['status' => Bid::BIDS_CANCELED]);
                }
            }
        } else {
            PPBid::query()
                ->whereIn('pp_bid_id', $ppBidsCodes)
                ->update(['status' => PPBid::TYPE_ERROR]);
            Transaction::query()
                ->whereIn('id', $transactionsId)
                ->update(['status' => Transaction::STATUS_FAILED]);
            Bid::query()
                ->whereIn('p_p_bid_id', $ppBidsCodes)
                ->update(['status' => Bid::BIDS_CANCELED]);
        }
    }

    private function ppBidsCancel(Collection $ppBids)
    {
        $transactionsId = [];
        $bidsId = [];

        foreach ($ppBids as $ppBid) {
            if ($ppBid->bids) {
                foreach ($ppBid->bids as $bid) {
                    $transaction = ManageService::createTransaction($bid, Transaction::TYPE_BID_CANCELED);
                    $transactionsId[] = $transaction->id;
                    $bidsId[] = $bid->id;
                }
            }
            if (PPInteraction::bidCancel($ppBid)) {
                Transaction::query()
                    ->whereIn('id', $transactionsId)
                    ->update(['status' => Transaction::STATUS_SUCCESS]);
                $ppBid->update(['status' => PPBid::TYPE_CANCEL]);
            } else {
                Transaction::query()
                    ->whereIn('id', $transactionsId)
                    ->update(['status' => Transaction::STATUS_FAILED]);
                $ppBid->update(['status' => PPBid::TYPE_ERROR]);
            }
        }
    }

}
