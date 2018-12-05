<?php

namespace App\Console\Commands;

use App\Http\Services\CMSHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use League\Flysystem\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;


class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:db';

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
     * @throws \Exception
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection(
            env('MPPL-CMS_AMQP_HOST'),
            env('MPPL-CMS_AMQP_PORT'),
            env('MPPL-CMS_AMQP_USER'),
            env('MPPL-CMS_AMQP_PASSWORD'),
            env('MPPL-CMS_AMQP_VHOST')
        );
        $channel = $connection->channel();
        $queueName = env('MPPL-CMS_AMQP_QUEUE');

        Log::info(' [*] Waiting for messages.');
        $callback = function ($msg) {
            $helper = new CMSHelper();

            if($helper->execute($msg->body)){
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            };
        };
        $channel->basic_consume($queueName, '', false, false, false, false, $callback);
        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
