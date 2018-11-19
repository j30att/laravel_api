<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 13.11.18
 * Time: 18:32
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\PPRequest;
use App\Models\PPResponse;
use App\Models\Sale;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PPInteraction
{

    public static function bidPlace(Bid $bid)
    {

        $sale = $bid->sale;
        $event = $sale->event;

        $user = Auth::user();
        $ppUser = $user->ppUser;
        $creator = $bid->sale->creator;
        $ppCreator = $creator->ppUser;


        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction/';


        $guzzleClient = new Client();

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountId' => $ppUser->party_poker_login,
            'amount' => (integer)($bid->amount * 100),
            'transactionType' => Bid::BID_PLACE,
            'requestorReferenceId' => $bid->transaction_code,
            'transactionInitiatedDate' => $bid->transaction_initiated_date,
            'brand' => 'PARTYPOKER',
            "tournamentDetails" => [
                "sellerAccountId" => $ppCreator->party_poker_login,
                "mainEvent" => $event->title,
                "tournamentId" => $event->id,
                "venuId" => $event->venue_id,
                "venuName" => $event->venue_name,
                "currency" => $event->currency
            ]
        ];



        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();

            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(),1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_PLACE_BID;
            $PPResponse->response = $response->getBody()->getContents();

            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;
            //$PPResponse->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }


    }

    public static function bidChange(Bid $bid, $oldAmount)
    {
        $sale = $bid->sale;
        $event = $sale->event;

        $user = Auth::user();
        $ppUser = $user->ppUser;
        $creator = $bid->sale->creator;
        $ppCreator = $creator->ppUser;

        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/bidamendedinfo/';


        $guzzleClient = new Client();


        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountName' => $ppUser->party_poker_login,
            'newBidAmount' => (integer)($bid->amount * 100),
            'oldBidAmount' => (integer)($oldAmount*100),
            "tournamentDetails" => [
                "sellerAccountId" => $ppCreator->party_poker_login,
                "mainEvent" => $event->title,
                "tournamentId" => $event->id,
                "venuId" => $event->venue_id,
                "venuName" => $event->venue_name,
                "currency" => $event->currency
            ]
        ];

        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();


            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(),1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_BID_CHANGE;
            $PPResponse->response = $response->getBody()->getContents();

            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }
    }

    public static function bidCancel(Bid $bid)
    {
        $user = Auth::user();
        $sale = $bid->sale;
        $ppUser = $user->ppUser;
        $event = $sale->event;
        $salerUser = $sale->creator;
        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction/';


        $guzzleClient = new Client();


        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $user->pp_partner_player_session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountId' => 'pp_' . $ppUser->screen_name,
            'amount' => $bid->amount * 100,
            'transactionType' => Bid::BID_CANCEL,
            'requestorReferenceId' => $bid->transaction_code,
            'transactionInitiatedDate' => $bid->transaction_initiated_date,
            'brand' => 'PARTYPOKER',
            "tournamentDetails" => [
                "sellerAccountId" => 'pp_' . $salerUser->ppUser->screen_name,
                "mainEvent" => $event->title,
                "tournamentId" => $event->id,
                "venuId" => $event->venue_id,
                "venuName" => $event->venue_name,
                "currency" => $event->currency
            ]
        ];

        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();

            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(),1);


            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_BID_CANCEL;
            $PPResponse->response = $response->getBody()->getContents();
            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];

            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;

            $PPResponse->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }
    }

    public static function bidClosure(Bid $bid)
    {
        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/bidClosure/';

        $guzzleClient = new Client();


        $header = [
            'Content-Type' => 'application/json',
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'transactionIds' => []
        ];

        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();

            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(),1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_BID_CLOSURE;
            $PPResponse->response = $response->getBody()->getContents();


            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }
    }

    public static function payRemaining(Sale $sale, $remaining)
    {

        $event = $sale->event;

        $user = Auth::user();
        $ppUser = $user->ppUser;

        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction/';
        $guzzleClient = new Client();

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountId' => $ppUser->party_poker_login,
            'amount' => (integer)($remaining * 100),
            'transactionType' => Bid::BID_PAY_REMAINING,
            'requestorReferenceId' => $sale->transaction_code,
            'transactionInitiatedDate' => $sale->transaction_initiated_date,
            'brand' => 'PARTYPOKER',
            "tournamentDetails" => [
                "sellerAccountId" => $ppUser->party_poker_login,
                "mainEvent" => $event->title,
                "tournamentId" => $event->id,
                "venuId" => $event->venue_id,
                "venuName" => $event->venue_name,
                "currency" => $event->currency
            ]
        ];

        try {

            $ppRequest = new PPRequest();
            $ppRequest->sale_id = $sale->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $remaining;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();


            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);
            $responseContent = json_decode($response->getBody()->getContents(),1);

            $PPResponse = new PPResponse();
            $PPResponse->sale_id = $sale->id;
            $PPResponse->type = PPResponse::TYPE_BID_REMAINING;
            $PPResponse->response = $response->getBody()->getContents();

            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }
    }


    public static function fxRates()
    {

        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/fxRates/';
        $guzzleClient = new Client();

        $header = [
            'Content-Type' => 'application/json',
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        try {
        $response = $guzzleClient->request('POST', $uri, [
            'headers' => $header,
            'json' => ['date'=> "01-11-2018"]
        ]);

        dd($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error($e->getMessage());

        }

    }
}