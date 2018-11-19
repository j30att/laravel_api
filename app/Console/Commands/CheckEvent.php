<?php

namespace App\Console\Commands;

use App\Http\Services\PPInteraction;
use App\Models\Event;
use App\Models\PPRequest;
use App\Models\PPResponse;
use App\Models\Sale;
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
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();

        $events = Event::query()->where('status', Event::STATUS_ACTIVE)->with('sales')->get();
        foreach ($events as $event) {
            $startDate = Carbon::parse($event->date_start);
            if ($now->gte($startDate)) {
                $event->status = Event::STATUS_CLOSED;
                //$event->save();
                foreach ($event->sales as $sale) {
                    if ($sale->fill_status == Sale::TYPE_FULL) {
                        $walletReferenceIds = [];
                        $saleResponse = PPResponse::query()
                            ->where('sale_id', $sale->id)
                            ->where('type', PPResponse::TYPE_BID_REMAINING)
                            ->where('status', 'SUCCESS')->first();

                        if (!is_null($saleResponse)) $walletReferenceIds[] = $saleResponse->wallet_references_id;
                        foreach ($sale->bids as $bid) {
                            $bidResponse = PPResponse::query()
                                ->where('bid_id', $bid->id)
                                ->where('status', 'SUCCESS')->first();
                            $walletReferenceIds = $bidResponse->wallet_references_id;
                        }

                        PPInteraction::bidClosure($walletReferenceIds);
                    } else {
                        PPRequest::query()->where('sale_id', $sale->id)->
                        PPInteraction::bidCancel(null, $sale);
                        foreach ($sale->bids as $bid) {
                            PPInteraction::bidCancel($bid, null);
                        }
                    }
                }
            }
        }
    }
}
