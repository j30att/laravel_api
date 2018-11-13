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

    protected $uri = 'http://re-partnerservices.ivycomptech.co.in/api?partner=staking&partnerAccountId=staking';

    public function authentication()
    {
        $user = Auth::user();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"partnerToken\": $user->pp_partner_token,\n    \"accountId\": \"$user->pp_account_id\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        dd($result);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);


    }

}
/*
curl -X POST \
'http://re-partnerservices.ivycomptech.co.in/api?partner=staking&partnerAccountId=staking' \
-H 'Content-Type: application/json' \
-d '{
    "partnerToken": "9285bf4c-46c0-4c78-8ead-18930742a500",
    "accountId": "116186665"
}'*/