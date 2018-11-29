<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 12.11.18
 * Time: 18:44
 */

namespace App\Http\Services;

use App\Models\PPUser;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PPValidate
{

    public static function authentication(User $user)
    {
        try {
            Log::info('[*] start validate user_id: ' . $user->id . ' user_name: '. $user->name);
            $response = PPValidate::getPPSession($user);

            PPValidate::savePPUser($user, $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    public static function getPPSession(User $user):array {
        $uri = config('api.pp_partner_host').'/api?partner='.config('api.pp_partner').'&partnerAccountId='.config('api.pp_accountId');

        Log::info('[*] url to link pp'.  $uri);

        $header = [
            'Content-Type' => 'application/json',
        ];

        $body = [
            'partnerToken'  => $user->pp_partner_token,
            'accountId'     => $user->pp_account_id
        ];

        $response = self::request($uri, $header, $body);
        $json = $response->getBody()->getContents();
        $result = json_decode($json, 1);

        Log::info('[*] Response Result');
        Log::info($result);
        return $result;
    }

    public static function savePPUser(User $user, $response){
        $ppUser = $user->ppUser;
        Log::info('[*] PPUSER');
        Log::info($ppUser);
        if ($response['result']) {
            if ($response['result'] == 'SUCCESS') {
                if (is_null($ppUser)) {
                    $ppUser = new PPUser();
                    $ppUser->user_id = $user->id;
                }
                $ppUser->result = $response['result'];
                $ppUser->first_name = $response['firstName'];
                $ppUser->last_name = $response['lastName'];
                $ppUser->account_id = $response['accountId'];
                $ppUser->screen_name = $response['screenName'];
                $ppUser->funded = $response['funded'];
                $ppUser->session = $response['partnerPlayerSession'];
                $ppUser->save();
            }
        }
        Log::info('[*] ppUser created');
    }

    private static function request($uri, $header, $body)
    {
        $guzzleClient = new Client();

        if (config('api.useProxy') && config('api.proxyIP')) {

            return $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body,
                'proxy' => config('api.proxy')
            ]);
        }

        return $guzzleClient->request('post', $uri, [
            'headers' => $header,
            'json' => $body
        ]);
    }

}