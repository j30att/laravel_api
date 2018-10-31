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
use App\Models\Event;
use App\Models\User;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

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

    }
}
