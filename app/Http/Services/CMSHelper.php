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
            if (is_null($eventData->event->deletedAt)) {
                if (is_null($event)) {
                    $event = new Event();
                    $event->id = $eventId;
                }

                $event->title = $eventData->event->eventName;
                $event->date_start = $eventData->event->eventStartDate;
                $event->date_end = $eventData->event->eventEndDate;
                $event->country = $eventData->event->eventCountry;
                $event->buy_in = $eventData->event->eventBuyIn;
                $event->currency = $eventData->event->eventCurrency;
                $event->slug = $eventData->event->eventNameSlug;
                $event->logo = $eventData->event->eventLogo;
                $event->country_id = $this->updateCountries();

                $event->save();

            }
        }

    }

    public function updateSchedule(){

        $scheduleUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/events/schedules/105';
        $apiResource = $this->guzzle->get($scheduleUri);
        $event = json_decode($apiResource->getBody());


        foreach ($event->event->days as $day){

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