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
            $logContext = array(
                $msgDetails["entityName"],
                $msgDetails["entityId"],
            );

            switch ($msgDetails["entityName"]) {
                case 'AppBundle\Entity\Event':
                    $status = $this->updateEvent($msgDetails["entityId"]);
                    break;

                case 'AppBundle\Entity\Schedule':
                    $status = $this->updateSchedule($msgDetails["entityId"]);
                    break;

                case 'AppBundle\Entity\Day':
                    $status = $this->updateDay($msgDetails["entityId"]);
                    break;

                default:
                    //Burn the message as we are not interested in any entities not listed above
                    $this->logger->info("Message burnt", $logContext);
                    $status = true;
                    break;

            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::error($msgDetails["entityName"] . ' ' . $e->getMessage());

        }
    }

    public function updateEvent($eventId): string
    {
        //https://dev.cms.mypartypokerlive.com/en/api/mobile/events/current-and-upcoming/countries?_format=json
        $eventUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/events/event_only/' . $eventId;//.'?softdeleteable=0';
        $apiResource = $this->guzzle->get($eventUri);

        if ('200' == $apiResource->getStatusCode()) {
            $event = Event::query()->find($eventId);

            $eventData = json_decode($apiResource->getBody());


            $country_code = $eventData->event->eventCountry;
            $country = json_decode(Country::query()->where('code', $country_code)->get());
            $country_id = $country[0]->id;

            dd($eventData->event);

            //dd($eventData->event->eventCountry);
            if (is_null($eventData->event->deletedAt)) {
                if (is_null($event)) {
                    $event = new Event();
                    $event->id = $eventId;
                }

                $event->title = $eventData->event->eventName;
                $event->date_start = $eventData->event->eventStartDate;
                $event->date_end = $eventData->event->eventEndDate;
                $event->buy_in = $eventData->event->eventBuyIn;

                $event->slug = $eventData->event->eventNameSlug;
                $event->logo = $eventData->event->eventLogo;

                $event->country_id = $country_id;

                $event->event_time_zone = $eventData->event->eventTimeZone;
                $event->event_venue_address_str = $eventData->event->eventVenueAddressStr;

                $event->first_live_day = Carbon::parse($eventData->event->firstLiveDayDate);
                $event->last_live_day = Carbon::parse($eventData->event->lastLiveDayDate);
                $event->first_day_date = Carbon::parse($eventData->event->firstDayDate);
                $event->last_day_date = Carbon::parse($eventData->event->lastDayDate);
                $event->start_date_time = Carbon::parse($eventData->event->startDateTime);
                $event->late_reg = Carbon::parse($eventData->event->lateReg);

                $event->time_zone = $eventData->event->eventTimeZone;
                $event->currency = $eventData->event->eventCurrency;




                $event->save();

                //dd($event);

                $this->updateSchedule();

            }
        }

    }

    public function updateSchedule(){

        $scheduleUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/events/schedules/105';
        $apiResource = $this->guzzle->get($scheduleUri);
        $event = json_decode($apiResource->getBody());


        foreach ($event->event->days as $day){
            $subEvent = SubEvent::query()->find($day->id);

            if (is_null($subEvent)){
                $subEvent = new SubEvent();
                $subEvent->id = $day->id;
            }

            $subEvent->event_id = '1';
            $subEvent->title    = 'sub_event';
            $subEvent->fund     = 500;
            $subEvent->buy_in   = 500;
            $subEvent->type     = $day->type;
            $subEvent->day      = $day->day;
            $subEvent->flight   = $day->flight;
            $subEvent->late_reg = Carbon::parse($day->lateReg);
            $subEvent->clock    = $day->clock;
            $subEvent->save();

        }

    }

    public function updateCountries()
    {



        //todo куда идти  за странами по коду

        //$countryUri = 'https://dev.cms.mypartypokerlive.com/en/api/mobile/events/current-and-upcoming/countries?_format=json';
        //$countryUri = 'https://dev.cms.mypartypokerlive.com/en/api/mobile/events/current-and-upcoming/countries?_format=json';
        //$countryUri = 'https://dev.cms.mypartypokerlive.com/en/api/mobile/events/current-and-upcoming/countries?_format=json';
//        $apiResource = $this->guzzle->get($countryUri);
//
//        if ('200' == $apiResource->getStatusCode()) {
//            $countryData = json_decode($apiResource->getBody());
//
//
//            $country = Country::query()->where('code', $countryData->country)->first();
//            if (is_null($country)) {
//                $country = new Country();
//            }
//            $country->name = $countryData->country_name;
//            $country->code = $countryData->country;
//            $country->slug = str_slug($countryData->country_name, '_');
//            $country = $country->save();
//
//            return $country->id;
//        }

    }
}
