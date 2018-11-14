<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 31.10.18
 * Time: 16:24
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\Dealer\EventResource;
use App\Http\Resources\Dealer\UserResource;
use App\Http\Resources\Dealer\ProfileResource;
use App\Http\Services\BetsManageService;
use App\Models\Event;
use App\Models\Result;
use App\Models\Sale;
use App\Models\SubEvent;
use App\Models\User;
use function Couchbase\defaultDecoder;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DealerController
{
    public function usersList(){


        $users = User::query()
            ->with('sales')
            ->with('bids')
            ->get();

        return UserResource::collection($users);
    }

    public function eventsList(){
        $events = Event::query()->get();

        return EventResource::collection($events);
    }

    public function eventDetail(Request $request){

        $id = $request->get('id');

        $event = Event::query()
            ->with('subEvents')
            ->with(['sales'=>function($query){
                $query->with('creator');
                //$query->with('bids');
                $query->with(['bids' => function($query){
                    $query ->with('investor');
                }]);
            }])
            ->find($id);
        return  new EventResource($event);
    }

    public  function profileDetail(Request $request){

        $user_id = $request->get('id');

        $user = User::query()
            ->with('country')
            ->where('id', $user_id)
            ->with(['sales'=>function($query){
                $query->with('bids');
                $query->with('event');
            }])
            ->get();


        return ProfileResource::collection($user);
    }

    public function currencyList(){

        $currency = DB::table('currency')->get();

        return $currency;
    }

    public function resultSale(Request $request){
        $dataResult = $request->get('result');


        //dd($dataResult);


        $result = new Result();

        $result->sale_id = $dataResult['sale_id'];
        $result->result = $dataResult['placed'];
        $result->prize = $dataResult['amount'];
        $result->currency_id = $dataResult['currency_id'];

        $result->save();


        BetsManageService::manageWins($result);


    }
}
