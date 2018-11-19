<?php

namespace App\Console\Commands;

use App\Models\Event;
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
            if ($now->gte($startDate)){
                $event->status = Event::STATUS_CLOSED;
                $event->save();


            }
        }
    }
}
