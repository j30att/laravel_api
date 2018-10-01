<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(SubEventsSeeder::class);
        $this->call(FlightsTableSeeder::class);
    }
}
