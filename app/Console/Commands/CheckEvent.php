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
        $now = Carbon::now();
        /** @var Event[] $events */
        $events = Event::query()
            ->where('status', Event::STATUS_ACTIVE)
            ->with('sales')
            ->get();

        foreach ($events as $event) {
            $startDate = Carbon::parse($event->date_start);

            if ($now->gte($startDate)) {
                foreach ($event->sales as $sale) {
                    $transactionsId = [];
                    $canceledBidsId = [];
                    $bidsId = [];

                    $ppBids = PPBid::query()
                        ->where('sale_id', $sale->id)
                        ->with('bids')
                        ->get();

                    $ppBidsCodes = $ppBids->pluck('pp_bid_id')->toArray();
                    $ppBidsId = $ppBids->pluck('id')->toArray();

                    if ($ppBids) {
                        if ($sale->fill_status) {
                            foreach ($ppBids as $ppBid) {
                                if ($ppBid->bids) {
                                    foreach ($ppBid->bids as $bid) {
                                        $transaction = ManageService::createTransaction($bid, Transaction::TYPE_BID_CLOSURE);
                                        $transactionsId[] = $transaction->id;
                                    }
                                }
                            }

                            $statuses = PPInteraction::bidClosure($ppBidsCodes);
                            if ($statuses) {
                                foreach ($statuses as $ppBidId => $status) {
                                    /** @var PPBid $ppBid */
                                    $ppBid = PPBid::query()->find($ppBidId)->with('bids');
                                    if ($ppBid && $status == 'SUCCESS') {
                                        $ppBid->update(['status' => PPResponse::TYPE_BID_CLOSURE]);
                                        if ($ppBid->bids) {
                                            $ppBid->bids()
                                                ->where('status', Bid::BIDS_MATCHED)
                                                ->update(['status' => Bid::BIDS_SETTLED]);
                                            $ppBid->bids()
                                                ->where('status', Bid::BIDS_UNMATCHED)
                                                ->update(['status' => Bid::BIDS_CANCELED]);
                                        }
                                    }
                                }
                                Transaction::query()
                                    ->whereIn('id', $transactionsId)
                                    ->update(['status' => Transaction::STATUS_SUCCESS]);
                                $event->update(['status' => Event::STATUS_CLOSED]);
                            } else {
                                Transaction::query()
                                    ->whereIn('id', $transactionsId)
                                    ->update(['status' => Transaction::STATUS_FAILED]);
                                Bid::query()
                                    ->whereIn('p_p_bids_id', $ppBidsCodes)
                                    ->update(['status' => Bid::BIDS_CANCELED]);
                            }
                        } else {
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
                                    Bid::query()
                                        ->whereIn('id', $bidsId)
                                        ->update(['status' => Bid::BIDS_CANCELED]);
                                    $ppBid->update(['status' => PPResponse::TYPE_BID_CANCEL]);
                                    $event->update(['status' => Event::STATUS_CLOSED]);
                                } else {
                                    Transaction::query()
                                        ->whereIn('id', $transactionsId)
                                        ->update(['status' => Transaction::STATUS_FAILED]);
                                }
                            }
                            $sale->update(['status' => Sale::SALE_CLOSED]);
                        }
                    }
                }
            }
        }
    }

}
