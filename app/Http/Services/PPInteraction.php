<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 13.11.18
 * Time: 18:32
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\Event;
use App\Models\Sale;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class PPInteraction
{

    public static function bidPlace(Bid $bid, Sale $sale)
    {
        $user = Auth::user();
        $ppUser = $user->ppUser;
        $event = $sale->event;
        $salerUser = $sale->creator;
        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction/';


        $guzzleClient = new Client();


        $header = [
            'Content-Type'   =>'application/json',
            'player-session' => $user->pp_partner_player_session,
            'auth-token'     => 'staking:pg:Test:ReleaseB',
            'partner-name'   => 'partner-name'
        ];

        $body = [
            'accountId'                 => $ppUser->screen_name,
            'amount'                    => $bid->amount * 100,
            'transactionType'           => Bid::BID_PLACE,
            'requestorReferenceId'      => $bid->transaction_code,
            'transactionInitiatedDate'  => $bid->transaction_initiated_date,
            'brand'                     => 'PARTYPOKER',
            "tournamentDetails"=>[
                        "sellerAccountId"   =>'pp_' . $salerUser->ppUser->screen_name,
                        "mainEvent"         =>$event->title,
                        "tournamentId"      =>$event->id,
                        "venuId"            =>$event->venue_id,
                        "venuName"          =>$event->venue_name,
                        "currency"          =>$event->currency
            ]
        ];

        $response = $guzzleClient->request('post', $uri,['headers'=>$header, 'body'=>$body]);
        dd($response);

    }

    public function bidChange(){

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