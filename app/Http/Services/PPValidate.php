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

    protected $uri = '/api?partner=staking&partnerAccountId=staking';

    public function __construct()
    {
        $this->guzzle = new Client(['base_uri'=>'http://re-partnerservices.ivycomptech.co.in']);
    }

    public function authentication()
    {
        $user = User::query()->find(5);
     //   $user = Auth::user();
        $data = [
            'partnerToken' => $user->pp_partner_token,
            'accountId' => $user->pp_account_id
        ];

        $request = $this->guzzle->request('POST', $this->uri, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'form_params' => \GuzzleHttp\json_decode('{
    "partnerToken": "9285bf4c-46c0-4c78-8ead-18930742a500",
    "accountId": "116186665"
}')
        ]);

        dd($request->getBody());

    }

}
/*
18d4acc2-926a-4ebf-a642-c2d2297d2c79

curl -v -X POST \
 'http://re-partnerservices.ivycomptech.co.in/api?partner=staking&partnerAccountId=staking' \
-H 'Content-Type: application/json' \
--data '{"partnerToken":"9285bf4c-46c0-4c78-8ead-18930742a500","accountId":"116186665"}'

curl -X POST \
'http://re-partnerservices.ivycomptech.co.in/api?partner=staking&partnerAccountId=staking' \
-H 'Content-Type: application/json' \
-d '{
    "partnerToken": "9285bf4c-46c0-4c78-8ead-18930742a500",
    "accountId": "116186665"
}'*/