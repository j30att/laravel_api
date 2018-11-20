<?php

namespace App\Console\Commands;

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
                $event->update(['status' => Event::STATUS_CLOSED]);
                foreach ($event->sales as $sale) {
                    if ($sale->status == Sale::SALE_CLOSED) {
                        $ppBids = PPBid::query()->where('sale_id', $sale->id)->get();
                        $ppBidsIds = $ppBids->pluck('id')->toArray();
                        $transaction = new Transaction();

                        PPInteraction::bidClosure($ppBidsIds);
                    } else {
                        $ppBids = PPBid::query()->where('sale_id', $sale->id)->get();
                            foreach ($ppBids as $ppBid){
                                PPInteraction::bidCancel($ppBid);
                            }
                        $sale->update(['status'=>Sale::SALE_CLOSED]);
                    }
                }
            }
        }
    }

}
