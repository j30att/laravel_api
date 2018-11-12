<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 12.11.18
 * Time: 18:44
 */

namespace App\Http\Services;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PPValidate
{

    protected $uri = 'http://re-partnerservices.ivycomptech.co.in/api?partner=staking&partnerAccountId=staking;';

    public function __construct()
    {
        $this->guzzle = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);
    }

    public function authentication()
    {
        $user = User::query()->find(5);
        $data = [
            'partnerToken' => $user->pp_partner_token,
            'accountId' => $user->pp_account_id
        ];

        $request = $this->guzzle->request('POST', $this->uri, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            $data
        ]);

        dd($request->getBody());

    }

}