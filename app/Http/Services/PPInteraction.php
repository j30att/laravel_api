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
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PPInteraction
{

    public static function bidPlace(Bid $bid)
    {
        $sale = $bid->sale;
        $event = $sale->event;

        $user = $bid->investor;
        $ppUser = $user->ppUser;
        $creator = $bid->sale->creator;
        $ppCreator = $creator->ppUser;

        $uri = config('api.host') . '/api/rest/staking/wallet/transaction/';

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => config('api.authToken'),
            'partner-name' => config('api.partnerName')
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

            $response = self::request($uri, $header, $body);

            $json = $response->getBody()->getContents();

            $responseContent = json_decode($json, 1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_PLACE_BID;
            $PPResponse->response = $json;
            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];
            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();

            if ($responseContent['status'] == 'SUCCESS') {
                $PPBid = new PPBid();
                $PPBid->pp_bid_id = $responseContent['walletReferenceId'];
                $PPBid->sale_id = $sale->id;
                $PPBid->amount = $bid->amount;
                $PPBid->status = PPResponse::TYPE_PLACE_BID;
                $PPBid->save();
                return $PPBid;
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage() . " ## " . $e->getFile() . ":" . $e->getLine());
            Log::info(serialize($body));
        }

        return false;
    }

    public static function bidChange(Bid $bid, PPBid $PPBid)
    {
        /** @var User $user */
        $user = $bid->investor;
        $sale = $bid->sale;
        $event = $sale->event;
        $ppUser = $user->ppUser;
        $creator = $bid->sale->creator;
        $ppCreator = $creator->ppUser;
        $newAmount = $PPBid->amount + $bid->amount;

        $uri = config('api.host') . '/api/rest/staking/wallet/bidamendedinfo/';

        $guzzleClient = new Client();

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => config('api.authToken'),
            'partner-name' => config('api.partnerName')
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

            $json = $response->getBody()->getContents();
            $responseContent = json_decode($json, 1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_BID_CHANGE;
            $PPResponse->response = $json;
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

        } catch (\Exception $e) {
            Log::error($e->getMessage() . " ## " . $e->getFile() . ":" . $e->getLine());
            Log::info(serialize($body));
        }

        return false;
    }

    public static function bidCancel(PPBid $PPBid)
    {
        $sale = Sale::query()->where('id', $PPBid->sale_id)->first();
        $bid = Bid::query()->where('p_p_bid_id', $PPBid->pp_bid_id)->first();

        $event = $sale->event;
        $investor = $bid->investor;
        $salerUser = $sale->creator;

        $uri = config('api.host') . '/api/rest/staking/wallet/transaction/';

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $investor->ppUser->session,
            'auth-token' => config('api.authToken'),
            'partner-name' => config('api.partnerName')
        ];

        $body = [
            'accountId' => $investor->ppUser->party_poker_login,
            'amount' => (integer)$PPBid->amount * 100,
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


        try {
            $ppRequest = new PPRequest();
            $ppRequest->bid_id = $bid->id;
            $ppRequest->transaction_type = PPRequest::TYPE_BID_CANCEL;
            $ppRequest->amount = $PPBid->amount;
            $ppRequest->headers = json_encode($header);
            $ppRequest->body = json_encode($body);
            $ppRequest->save();

            $response = self::request($uri, $header, $body);

            $json = $response->getBody()->getContents();
            $responseContent = json_decode($json, 1);

            $PPResponse = new PPResponse();
            $PPResponse->bid_id = $bid->id;
            $PPResponse->type = PPResponse::TYPE_BID_CANCEL;
            $PPResponse->response = $json;
            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];
            $PPResponse->p_p_request = $ppRequest->id;

            if ($PPResponse->save() && $PPResponse->status === "SUCCESS") {
                return true;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " ## " . $e->getFile() . ":" . $e->getLine());
            Log::info(serialize($body));
        }

        return false;
    }

    public static function bidClosure($transactions)
    {
        $uri = config('api.host') . '/api/rest/staking/wallet/bidClosure/';

        $header = [
            'Content-Type' => 'application/json',
            'auth-token' => config('api.authToken'),
            'partner-name' => config('api.partnerName')
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


            $response = self::request($uri, $header, $body);

            $json = $response->getBody()->getContents();
            $responseContent = json_decode($json, 1);

            $PPResponse = new PPResponse();
            $PPResponse->type = PPResponse::TYPE_BID_CLOSURE;
            $PPResponse->response = $json;

            if (is_array($responseContent['status'])) {
                foreach ($responseContent['status'] as $status) {
                    $PPResponse->status = $status;
                    if ($status == 'FAILED') {
                        break;
                    }
                }
            }

            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];
            $PPResponse->p_p_request = $ppRequest->id;

            if ($PPResponse->save()) {
                return $responseContent['status'];
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage() . " ## " . $e->getFile() . ":" . $e->getLine());
            Log::info(serialize($body));
        }

        return false;
    }

    public static function payRemaining(Sale $sale, $remaining)
    {
        /** @var User $user */
        $user = Auth::user();
        $ppUser = $user->ppUser;
        $event = $sale->event;

        $uri = config('api.host') . '/api/rest/staking/wallet/transaction/';

        $header = [
            'Content-Type' => 'application/json',
            'player-session' => $ppUser->session,
            'auth-token' => config('api.authToken'),
            'partner-name' => config('api.partnerName')
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

            $response = self::request($uri, $header, $body);

            $json = $response->getBody()->getContents();
            $responseContent = json_decode($json, 1);

            $PPResponse = new PPResponse();
            $PPResponse->sale_id = $sale->id;
            $PPResponse->type = PPResponse::TYPE_BID_REMAINING;
            $PPResponse->response = $json;

            $PPResponse->status = $responseContent['status'];
            $PPResponse->error_code = $responseContent['errorCode'];
            $PPResponse->error_description = $responseContent['errorDescription'];
            $PPResponse->wallet_references_id = $responseContent['walletReferenceId'];
            $PPResponse->p_p_request = $ppRequest->id;
            $PPResponse->save();

            if ($responseContent['status'] == 'SUCCESS') {
                return $responseContent['walletReferenceId'];
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' : ' . $e->getFile() . ' : ' . $e->getLine());
            Log::info(serialize($body));
        }
        return false;
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

    private static function request($uri, $header, $body)
    {
        $guzzleClient = new Client();

        if (config('api.useProxy') && config('api.proxy')) {

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