<?php

use Illuminate\Database\Seeder;

class SubEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subEvents = [
            0 => [
                'event_id' => '1',
                'title' => 'saturday',
                'fund' => '500000',
                'date_start' => '2018-09-21 09:00:00',
                'date_end' => '2018-10-22 09:00:00'
            ],
            1 => [
                'event_id' => '1',
                'title' => 'sunday',
                'fund' => '500000',
                'date_start' => '2018-11-23 09:00:00',
                'date_end' => '2018-12-24 09:00:00'
            ],
            2 => [
                'event_id' => '2',
                'title' => 'monday',
                'fund' => '50000',
                'date_start' => '2019-01-21 09:00:00',
                'date_end' => '2019-03-21 09:00:00'
            ],
            3 => [
                'event_id' => '2',
                'title' => 'tuesday',
                'fund' => '60000',
                'date_start' => '2019-01-21 09:00:00',
                'date_end' => '2019-03-21 09:00:00'
            ],
            4 => [
                'event_id' => '3',
                'title' => 'wednesday',
                'fund' => '70000',
                'date_start' => '2019-01-21 09:00:00',
                'date_end' => '2019-03-21 09:00:00'
            ],
            5 => [
                'event_id' => '3',
                'title' => 'mega turbo',
                'fund' => '7000000',
                'date_start' => '2019-01-21 09:00:00',
                'date_end' => '2019-03-21 09:00:00'
            ],

        ];
        foreach ($subEvents as $subEvent) {
            \App\Models\SubEvent::create([
                'event_id' => $subEvent['event_id'],
                'title' => $subEvent['title'],

                'fund' => $subEvent['fund'],
                'date_start' => $subEvent['date_start'],
                'date_end' => $subEvent['date_end'],
            ]);
        }

    }
}

