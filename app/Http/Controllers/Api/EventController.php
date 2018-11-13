<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Events\EventDetailResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\Events\EventsList;
use App\Models\Country;
use App\Models\Event;
use Carbon\Carbon;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::query()->with('subEvents')->get();

        return EventResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return EventDetailResource
     */
    public function show($id)
    {
        $event = Event::query()
            ->where('id', $id)
            ->with('subEvents')
            ->with('sales')
            ->first();
        return new EventDetailResource($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function mainEvents()
    {
        //$events = Event::query()->take(6)->get();
        $events = Event::query()
            ->with('country')
            ->take(Event::LIMIT_EVENT_MAIN_PAGE)
            ->get();
        return EventsList::collection($events);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filteredEvents(Request $request)
    {
        $query = Event::query();
        $filter = $request->get('filter');
        $eventIds = [];
        $countryIds = [];
        if ($filter) {
            if(count($filter['events']) > 0){
                foreach ($filter['events'] as $event){
                    $eventIds[] = $event['id'];
                }
                $eventsFiltredEvent = Event::query()->whereIn('id', $eventIds)->get();

            }
            if(count($filter['countries']) > 0){
                foreach ($filter['countries'] as $country){
                    $countryIds[] = $country['id'];
                }
                $eventsFiltredCountry = Event::query()->whereIn('country_id', $countryIds)->get();
            }

            if (isset($eventsFiltredEvent) && isset($eventsFiltredCountry)){
                $events = $eventsFiltredCountry->merge($eventsFiltredEvent);
                return EventsList::collection($events);
            }
            if (isset($eventsFiltredEvent)){
                return EventsList::collection($eventsFiltredEvent);
            }
            if (isset($eventsFiltredCountry)){
                return EventsList::collection($eventsFiltredCountry);
            }
        }
        return $this-> mainEvents();
            //EventsList::collection($query->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getFilters(Request $request)
    {
        //$lastMonth = Carbon::now()->subMonth();
        $lastYear = Carbon::now()->subYear();

        $events = Event::query()
            ->orderBy('title')
            ->pluck('title', 'id')
            ->toArray();
        //$events[0] = 'All events';

        $countries = Country::query()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //$countries[0] = 'All regions';

        $filters = [
            'date' => [
                'placeholder' => 'Last month',
                'options' => [
                    0 => 'Last month',
                    $lastYear->toDateTimeString() => 'Last year',
                ]
            ],
            'event' => [
                'placeholder' => 'All events',
                'options' => $events,
            ],
            'country' => [
                'placeholder' => 'All regions',
                'options' => $countries
            ],
            'venue' =>  [
                'placeholder' => 'All venues',
                'options' => $countries
            ]
        ];

        return response()->json(['data' => $filters]);
    }


}
