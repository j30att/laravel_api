<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 15.11.18
 * Time: 17:33
 */

namespace App\Http\Controllers\Api;

use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController
{
    public function filterFlight(Request $request){
        $filter = $request->get('event_id');
        $flights = Flight::query()->where('event_id', $filter)->get();
        return FlightResource::collection($flights);
    }
}