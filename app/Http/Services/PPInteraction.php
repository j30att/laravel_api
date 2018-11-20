<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 13.11.18
 * Time: 18:32
 */

namespace App\Http\Services;


use App\Models\Bid;
use App\Models\PPBid;
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

            //$ppRequest = self::createRequest(null,$bid,$body,$header,null);
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

            $responseContent = json_decode($response->getBody()->getContents(), 1);


            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_PLACE_BID;
            $PPResponse->response = $response->getBody()->getContents();

            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];

            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();

            $PPBid = false;
            if ($responseContent['status'] == 'SUCCESS') {
                $PPBid = new PPBid();
                $PPBid->pp_bid_id = $responseContent['walletReferenceId'];
                $PPBid->sale_id = $sale->id;
                $PPBid->amount = $bid->amount;
                $PPBid->status = PPResponse::TYPE_PLACE_BID;
                $PPBid->save();
            }
            return $PPBid;


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }


    }

    public static function bidChange(Bid $bid, PPBid $PPBid)
    {
        $sale = $bid->sale;
        $event = $sale->event;

        $user = Auth::user();
        $ppUser = $user->ppUser;
        $creator = $bid->sale->creator;
        $ppCreator = $creator->ppUser;

        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/bidamendedinfo/';


        $guzzleClient = new Client();

        $newAmount = $PPBid->amount + $bid->amount;

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountName' => $ppUser->party_poker_login,
            'newBidAmount' => (integer)($newAmount * 100),
            'oldBidAmount' => (integer)($PPBid->amount * 100),
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
            $ppRequest->transaction_type = PPRequest::TYPE_BID_CHANGE;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();


            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(), 1);

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


            if ($responseContent['status'] == 'SUCCESS') {

                $PPBid->amount = $newAmount;
                $PPBid->status = PPResponse::TYPE_BID_CHANGE;
                $PPBid->save();
                return $PPBid;
            }
            return false;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(serialize($body));
        }
    }

    public static function bidCancel(PPBid $PPBid)
    {

        $sale = Sale::query()->where('id', $PPBid->sale_id)->first();
        $bid = Bid::query()->where('p_p_bid', $PPBid->id)->first();

        $event = $sale->event;
        $investor = $bid->investor;
        $salerUser = $sale->creator;

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $investor->ppUser->session,
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'accountId' => $investor->ppUser->party_poker_login,
            'amount' => (integer)$bid->amount * 100,
            'transactionType' => Bid::BID_CANCEL,
            'requestorReferenceId' => $bid->transaction_code,
            'transactionInitiatedDate' => $bid->transaction_initiated_date,
            'brand' => 'PARTYPOKER',
            "tournamentDetails" => [
                "sellerAccountId" => $salerUser->ppUser->party_poker_login,
                "mainEvent" => $event->title,
                "tournamentId" => $event->id,
                "venuId" => $event->venue_id,
                "venuName" => $event->venue_name,
                "currency" => $event->currency
            ]
        ];


        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/transaction/';
        $guzzleClient = new Client();
        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_BID_CANCEL;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();

            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);

            $responseContent = json_decode($response->getBody()->getContents(), 1);

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

    public static function bidClosure($transactions)
    {

        //todo

        $uri = 'http://re-crm-api-container.ivycomptech.co.in/api/rest/staking/wallet/bidClosure/';

        $guzzleClient = new Client();

        $header = [
            'Content-Type' => 'application/json',
            'auth-token' => 'staking:pg:Test:ReleaseB',
            'partner-name' => 'stakingapp'
        ];

        $body = [
            'transactionIds' => $transactions
        ];

        try {
            $ppRequest = new PPRequest();
            $ppRequest->transaction_type = PPRequest::TYPE_BID_CLOSURE;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();


            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);
            $responseContent = json_decode($response->getBody()->getContents(), 1);

            $PPResponse = new PPResponse();

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
            $ppRequest->transaction_type = PPRequest::TYPE_BID_REMAINING;
            $ppRequest->amount = $remaining;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();


            $response = $guzzleClient->request('post', $uri, [
                'headers' => $header,
                'json' => $body
            ]);
            $responseContent = json_decode($response->getBody()->getContents(), 1);

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
                'json' => ['date' => "01-11-2018"]
            ]);

            dd($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error($e->getMessage());

        }

    }

    private static function createRequest(Sale $sale = null, Bid $bid = null, $body, $header, $remaining)
    {
        if ($sale == null) {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_PLACE_BID;
            $ppRequest->amount = $bid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();
        } else {
            $ppRequest = new PPRequest();
            $ppRequest->sale_id = $sale->id;
            $ppRequest->transaction_type = PPRequest::TYPE_BID_REMAINING;
            $ppRequest->amount = $remaining;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();
        }
        return $ppRequest;

    }

    private static function createResponse(Sale $sale = null, Bid $bid = null, PPRequest $request)
    {

    }
}