<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 31.10.18
 * Time: 16:24
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\Dealer\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class DealerController
{
    public function usersList(){

    }

    public function eventsList(){
        $event = Event::query()->get();
        return EventResource::collection($event);
    }

    public function eventDetail(Request $request){

    }
}