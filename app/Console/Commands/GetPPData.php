<?php

namespace App\Console\Commands;

use App\Http\Services\CMSHelper;
use App\Http\Services\PPValidate;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class GetPPData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data';

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
        $helper = new CMSHelper();
        $msg = 'a:3:{s:10:"entityName";s:25:"AppBundle\Entity\Schedule";s:6:"action";s:6:"create";s:8:"entityId";i:1325;}';
        $msg = 'a:3:{s:10:"entityName";s:20:"AppBundle\Entity\Day";s:6:"action";s:6:"create";s:8:"entityId";i:53;}';

        $msg = 'a:3:{s:10:"entityName";s:22:"AppBundle\Entity\Event";s:6:"action";s:6:"create";s:8:"entityId";i:53;}';

        $helper->execute($msg);
    }
}
