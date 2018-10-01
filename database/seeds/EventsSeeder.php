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
            1 => [
                'title' => 'Caribbean Poker Party Event',
                'image_id' => null,
                'fund' => '1000000',
                'date_start' => new \DateTimeImmutable(sprintf('+%d days', 20)),
                'date_end' => new \DateTimeImmutable(sprintf('+%d days', 30)),
                'description' => '
<p>That’s right, the Caribbean Poker Party is back for 2017, and this time the main schedule—the partypoker MILLIONS
Caribbean—boasts an unbelievable <strong>$5 million guarantee</strong>! We’ve got an action-packed event lined up
with combined guarantees of a jaw-dropping <strong>$10,000,000</strong> with all kinds of buy-in levels and events.</p>
',
                'buy_in' => 10000,
                'reg_fee' => 1000,
                /*'currency_token' => 'USD',
                'country' => 'Bahamas',
                'category_slug' => 'Caribbean',
                'category_name' => 'caribbean'*/
            ],
            2 => [
                'title' => 'Las Vegas Poker Party',
                'image_id' => null,
                'fund' => '1000000',
                'date_start' => new \DateTimeImmutable(sprintf('+%d days', 40)),
                'date_end' => new \DateTimeImmutable(sprintf('+%d days', 45)),
                'description' => '<p>We’re giving players the chance to <strong>win one of 100 prize packages worth $12,000</strong> each for the
<strong>Las Vegas Poker Party</strong>strong>, a week-long extravaganza loaded with poolside fun, exciting nightlife,
award-winning golf, and a variety of live poker events that will show you the best Sin City has to offer!</p>',
                'buy_in' => 1000,
                'reg_fee' => 100,
                /*'currency_token' => 'USD',
                'country' => 'USA',
                'category_slug' => 'lasvegas',
                'category_name' => 'Las Vegas'*/
            ],
            3 => [
                'title' => 'partypoker MILLIONS',
                'image_id' => null,
                'fund' => '1000000000',
                'date_start' => new \DateTimeImmutable(sprintf('+%d days', 10)),
                'date_end' => new \DateTimeImmutable(sprintf('+%d days', 15)),
                'description' => '<p>Play your role in the biggest tournament in partypoker history and you could walk away with £1 million cash! We’re
going back to our roots to revive our first ever tourney, the partypoker MILLIONS, but this time it boasts an
unbelievable £6 million prizepool including at least £1 million for the winner!</p>',
                'buy_in' => 5000,
                'reg_fee' => 300,
                /*'currency_token' => 'GBP',
                'country' => 'UK',
                'category_slug' => 'millions',
                'category_name' => 'Millions'*/
            ],
            4 => [
                'title' => 'EAPT Kazakhstan',
                'image_id' => null,
                'fund' => '1000000000',
                'date_start' => new \DateTimeImmutable(sprintf('+%d days', 30)),
                'date_end' => new \DateTimeImmutable(sprintf('+%d days', 35)),
                'description' => '<p>There’s no limit to where partypoker LIVE events are held—wherever the players need us, we’ll be there! From 5th –
14th October we’re heading to the CashVille Casino in Borovoe for the Eurasian Poker Tour (EAPT) Kazakhstan event
including the main schedule from 10th – 14th October with a massive $500,000 gtd. The luxurious casino is located on the
brink of Shchuchie Lake in the awe-inspiring Burabay National Park, an 85,000 hectare area known for its exotic rocks
and gorgeous mountains. Take in the remarkable scenery, let loose at the nearby theme park then hit the tables for a
seriously big prizepool!</p>',
                'buy_in' => 2500,
                'reg_fee' => 250,
                /*'currency_token' => 'CAN',
                'country' => 'Kazakhstan',
                'category_slug' => 'EAPT',
                'category_name' => 'eapt'*/
            ],
        ];

        foreach ($events as $event){
            \App\Models\Event::create([
                'title' => $event['title'],
                'image_id' => null,
                'fund' => $event['fund'],
                'date_start' => $event['date_start'],
                'date_end' => $event['date_end'],
                'description' => $event['description'],
                'buy_in' => $event['buy_in'],
                'reg_fee' => $event['reg_fee'],
                /*'currency_token' => $event['currency_token'],
                'country' => $event['country'],
                'category_slug' => $event['category_slug'],
                'category_name' => $event['category_name']*/
            ]);
        }

    }
}
