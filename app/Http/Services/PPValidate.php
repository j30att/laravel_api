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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PPValidate
{

    public static function authentication(User $user)
    {
        try {
            $response = PPValidate::getPPSession($user);

            PPValidate::savePPUser($user, $response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    public static function getPPSession(User $user):array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('app.pp.pp_validate'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"partnerToken\": $user->pp_partner_token,\n    \"accountId\": \"$user->pp_account_id\"}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $result = json_decode($result, 1);
        return $result;
    }

    public static function savePPUser(User $user, $response){
        dd($response);
        $ppUser = $user->ppUser;
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
    }


}