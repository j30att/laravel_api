<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\SubEvent;
use Illuminate\Console\Command;

class FakeSubEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:subevents';

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
        $events = Event::query()->with('subEvents')->get();
        foreach ($events as $event){
            if (count($event->subEvents) == 0){
                $subevent = rand(1000000, 1100000);
                $subevent->id = $event->id;
                $subevent->event_id = $event->id;
                $subevent->title = $event->title;
                $subevent->fund = $event->fund;
                $subevent->buy_in = $event->buy_in;
                $subevent->date_start = $event->date_start;
                $subevent->date_end = $event->date_end;
                $subevent->save();

            }
        }
    }
}
