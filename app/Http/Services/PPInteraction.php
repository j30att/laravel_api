<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 13.11.18
 * Time: 18:32
 */

namespace App\Http\Services;


use App\Models\Event;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PPInteraction
{

    public static function bidPlace()
    {
        $guzzleClient = new Client();

        $now = Carbon::now();
        dd($now->timestamp);
        $event = Event::query()->with('SubEvents')->find(104);

        $user = Auth::user();
        $ppUser = $user->ppUser;
        //$uri = config('app.pp.pp_base_api_url'). '/wallet/transaction/';
        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction';
        $body = [
            'accountId' => $user->pp_account_id,
            'amount' => +10000,
            'transactionType' => 'BID_PLACE',
            'requestorReferenceId' => 'QAZzaq',
            'transactionInitiatedDate' => $now->timestamp,
            'tournamentDetails' => [
                "mainEvent" => $event->title,
                "tournamentId" => "$event->id",
                "venuId" => null,
                "venuName" => null,
                "currency" => "EUR"
            ]
        ];
        dd(json_encode($body));

        $headers = [
            'partnerName' => $ppUser->screen_name,
            'partnerAuthToken' => $user->pp_partner_token,//'staking:pg:Test:ReleaseB',
            'partnerPlayerSession' => $ppUser->session,
            'Content-Type' => 'application/json',
        ];
        $response = $guzzleClient->post($uri, [
            'headers' => ['partnerName' => $ppUser->screen_name,
                'partnerAuthToken' => 'staking:pg:Test:ReleaseB',
                'partnerPlayerSession' => $ppUser->session,
                'Content-Type' => 'application/json']
            /*'form_data'=>$body*/
        ]);
        dd($response);
    }

    public function bidCancel()
    {

    }

    public function bidClosure()
    {

    }

    public function bidPayRemaining()
    {

    }
}