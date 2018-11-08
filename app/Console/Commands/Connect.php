<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Console\Command;
use OAuth;


class Connect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'connect';

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
        //?partnerToken=ce36d4d3-1d0a-4e60-9d99-bbab71cceb6b&accountId=116186665
        //?partnerToken=22f479bf-ddc0-42a9-97f7-810aa54c0058&accountId=116186898
        $uri = 'https://releaseb-ciwic.ivycomptech.co.in/en_US/VC/login-staking.html?redirect_URI=http://devpoker.itsumma.ru';

        //$uri = 'https://releaseb-pp-core-api-poker.ivycomptech.co.in/login-v2/partnerLogin//VC/en_US';
        $client = new Client(['allow_redirects' => ['track_redirects' => true]]);

        $body = [
            'userName'  => 'party111',
            'password'     => '123123'
        ];
        $response = $client->post($uri, $body);


        dd($response->getHeader(RedirectMiddleware::HISTORY_HEADER));
    }
}
