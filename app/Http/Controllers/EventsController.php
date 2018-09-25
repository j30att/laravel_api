<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 24.09.18
 * Time: 20:35
 */

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;

class EventsController
{
    public function index(Request $request){
        $events = Event::query()->get();

        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.events.index', compact('events'));
    }

    public function eventsList(Request $request){
        $events = Event::query()->get();

        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.events.all-events', compact('events'));
    }

    public function event(Request $request, Event $event)
    {
        $subevents = $event->subevents()->get();

        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.events.single', compact('subevents'));
    }


}