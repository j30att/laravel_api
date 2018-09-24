<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 24.09.18
 * Time: 20:35
 */

namespace App\Http\Controllers;


use App\Models\Event;

class EventsController
{
    public function index(){
        $events = Event::query()->get();

        return view('events.index', compact('events'));
    }

    public function eventsList(){
        $eventList = Event::query()->get();
        return view('events.all-events', compact('eventList'));
    }

    public function event(Event $event)
    {
        return view('events.single');

    }
}