<?php

use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            0 => [
                'title' => 'super weekend',
                'image_id' => 1,
                'fund' => '1000000',
                'date_start' => '2018-09-21 09:00:00',
                'date_end' => '2018-10-21 09:00:00'
            ],
            1 => [
                'title' => 'daily majors',
                'image_id' => 1,
                'fund' => '500000',
                'date_start' => '2018-11-21 09:00:00',
                'date_end' => '2018-12-21 09:00:00'
            ],
            2 => [
                'title' => 'power turbos',
                'image_id' => 1,
                'fund' => '100000',
                'date_start' => '2019-01-21 09:00:00',
                'date_end' => '2019-03-21 09:00:00'
            ]
        ];

        foreach ($events as $event){
            \App\Models\Event::create([
                'title' => $event['title'],
                'image_id' => $event['image_id'],
                'fund' => $event['fund'],
                'date_start' => $event['date_start'],
                'date_end' => $event['date_end'],
            ]);
        }

    }
}
