<?php

use Illuminate\Database\Seeder;

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flights = [
            0 => [
                'event_id' => 1,
                'sub_event_id' => 1,
                'title' => 'qarter',

            ],
            1 => [
                'event_id' => 1,
                'sub_event_id' => 1,
                'title' => 'second loop',

            ],
            2 => [
                'event_id' => 1,
                'sub_event_id' => 2,
                'title' => 'first loop',

            ],
            3 => [
                'event_id' => 1,
                'sub_event_id' => 2,
                'title' => 'delve',

            ],
            4 => [
                'event_id' => 2,
                'sub_event_id' => 3,
                'title' => 'mile',

            ],
            5 => [
                'event_id' => 2,
                'sub_event_id' => 3,
                'title' => 'mega turbo',

            ],
            6 => [
                'event_id' => 2,
                'sub_event_id' => 4,
                'title' => 'mega',

            ],
            7 => [
                'event_id' => 2,
                'sub_event_id' => 4,
                'title' => 'turbo',

            ],
            8 => [
                'event_id' => 3,
                'sub_event_id' => 5,
                'title' => 'heads up',

            ],
            9 => [
                'event_id' => 3,
                'sub_event_id' => 5,
                'title' => 'short stack',

            ],
            10 => [
                'event_id' => 3,
                'sub_event_id' => 6,
                'title' => 'exile',

            ],
            11 => [
                'event_id' => 3,
                'sub_event_id' => 6,
                'title' => 'arena',

            ],
        ];
        foreach ($flights as $flight) {
            \App\Models\Flight::create([
                'event_id' => $flight['event_id'],
                'sub_event_id' => $flight['sub_event_id'],
                'title' => $flight['title'],
            ]);
        }
    }
}
