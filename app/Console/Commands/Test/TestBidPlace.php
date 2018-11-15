<?php

namespace App\Console\Commands\Test;

use App\Http\Services\PPInteraction;
use App\Models\Bid;
use App\Models\Sale;
use Illuminate\Console\Command;

class TestBidPlace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:bid_place';

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
        $this->info('start');


        $bid = Bid::orderBy('id')->first();
        $sale = $bid->sale;

        PPInteraction::bidPlace($bid, $sale);
    }
}
