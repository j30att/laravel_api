<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 02.11.18
 * Time: 13:36
 */

namespace App\Http\Services;


use App\Models\Country;
use App\Models\Event;
use App\Models\Flight;
use App\Models\SubEvent;
use Carbon\Carbon;
use GuzzleHttp\Client;
use http\Exception;
use Illuminate\Support\Facades\Log;

class CMSHelper
{

    //$dayUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/day/day/';

    protected $softDelete = '';

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    public function execute($msg)
    {

        Log::info('[x] Message received', [$msg]);
        try {

            $msgDetails = unserialize($msg);
            switch ($msgDetails["entityName"]) {
                case 'AppBundle\Entity\Event':
                    $this->updateEvent($msgDetails["entityId"]);
                    break;

                case 'AppBundle\Entity\Schedule':
                    $this->updateSchedule($msgDetails["entityId"]);
                    break;

                case 'AppBundle\Entity\Day':
                    $this->updateDay($msgDetails["entityId"]);
                    break;

                default:
                    Log::info('[x] Unprocessable entity');
                    break;

            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::error($msgDetails["entityName"] . ' ' . $e->getMessage());
        }
    }

    public function updateEvent($eventId)
    {
        $eventUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/events/event_only/' . $eventId;//.'?softdeleteable=0';
        $apiResource = $this->guzzle->get($eventUri);

        if ('200' == $apiResource->getStatusCode()) {
            $event = Event::query()->find($eventId);

            $eventData = json_decode($apiResource->getBody());
            $country = Country::query()->where('code', $eventData->event->eventCountry)->first();
            if (!$country) {
                Log::info('[x] Unprocessable entity');
                return false;
            }

            if (is_null($eventData->event->deletedAt)) {
                if (is_null($event)) {
                    $event = new Event();
                    $event->id = $eventId;
                }
                $event->title = $eventData->event->eventName;
                $event->description = $eventData->event->eventUpcomingAbout;
                $event->buy_in = $eventData->event->eventBuyIn;
                $event->reg_free = $eventData->event->eventRegFee;
                $event->fund = $eventData->event->eventUpcomingPrizepool;
                $event->slug = $eventData->event->eventNameSlug;
                $event->logo = $eventData->event->eventLogo;
                $event->country_id = $country->id;
                $event->currency = $eventData->event->eventCurrency;
                $event->venue_id = $eventData->event->eventVenueId;
                $event->venue_name = $eventData->event->eventVenueName;
                $event->date_end = Carbon::parse($eventData->event->eventEndDate);
                $event->date_start = Carbon::parse($eventData->event->eventStartDate);

                $event->save();

                if (count($eventData->event->schedules) > 0) {
                    foreach ($eventData->event->schedules as $schedule) {
                        $this->updateSchedule($schedule->id);
                        /*$subEvent = SubEvent::query()->find($schedule->id);

                        if (is_null($subEvent)) {
                            $subEvent = new SubEvent();
                            $subEvent->id = $schedule->id;
                        }

                        $subEvent->event_id = $schedule->event_id;
                        $subEvent->title = $schedule->scheduleTitle;
                        $subEvent->fund = $schedule->schedulePrizePool;
                        $subEvent->buy_in = $schedule->scheduleBuyIn;
                        $subEvent->save();*/
                    }
                }
            }
        }
    }

    public function updateSchedule($scheduleId)
    {
        Log::info("Update schedule ${scheduleId}");
        $scheduleUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/schedule/schedule/' . $scheduleId;

        $apiResource = $this->guzzle->get($scheduleUri);
        $ppSubEvent = json_decode($apiResource->getBody());



        $subEvent = SubEvent::query()->find($ppSubEvent->schedule->id);

        $event = Event::query()->find($ppSubEvent->schedule->event_id);

        if (!$event){
            Log::info('[x] Unprocessable entity');
            return false;
        }

        if (is_null($subEvent)) {
            $subEvent = new SubEvent();
            $subEvent->id = $ppSubEvent->schedule->id;
        }


        $subEvent->event_id = $ppSubEvent->schedule->event_id;
        $subEvent->title = $ppSubEvent->schedule->scheduleTitle;
        $subEvent->fund = isset($ppSubEvent->schedule->schedulePrizePool)?$ppSubEvent->schedule->schedulePrizePool: null;
        $subEvent->buy_in = $ppSubEvent->schedule->scheduleBuyIn;
        $subEvent->date_start = isset($ppSubEvent->schedule->firstDayDate)?$ppSubEvent->schedule->firstDayDate:null;
        $subEvent->date_end = isset($ppSubEvent->schedule->lastDayDate)?$ppSubEvent->schedule->lastDayDate:null;
        $subEvent->save();

        if (count($ppSubEvent->schedule->days)>0){
            foreach ($ppSubEvent->schedule->days as $ppDay){

                $this->updateDay($ppDay->id);
                /*$flight = Flight::query()->find($ppDay->day);
                if (is_null($flight)) {
                    $flight = new Flight();
                    $flight->id = $ppDay->id;
                }
                $flight->title = $ppDay->day . $ppDay->flight;
                $flight->type = $ppDay->type == 'live' ? Flight::TYPE_LIVE : Flight::TYPE_ONLINE;
                $flight->date = Carbon::parse($ppDay->date);
                $flight->flight = $ppDay->flight;
                $flight->day = $ppDay->day;
                $flight->save();*/
            }
        }
    }

    public function updateDay($dayId){
        $dayUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/day/day/'.$dayId;

        $apiResource = $this->guzzle->get($dayUri);
        $ppDay = json_decode($apiResource->getBody());

        $flight = Flight::query()->find($ppDay->day->id);
        if (is_null($flight)) {
            $flight = new Flight();
            $flight->id = $ppDay->day->id;
        }


        $subEvent = SubEvent::query()->where('id', $ppDay->day->schedule_id)->with('event')->first();

        $flight->sub_event_id = $ppDay->day->schedule_id;
        $flight->title = $ppDay->day->day . $ppDay->day->flight;
        $flight->type = $ppDay->day->type == 'live' ? Flight::TYPE_LIVE : Flight::TYPE_ONLINE;
        $flight->date = Carbon::parse($ppDay->day->date);
        $flight->flight = $ppDay->day->flight;
        $flight->day = $ppDay->day->day;
        $flight->event_id= $subEvent ? $subEvent->event->id : $ppDay->day->event_id;
        $flight->save();

    }

}
