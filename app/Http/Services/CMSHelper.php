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
use App\Models\Venue;
use App\Models\ImageAttachment;
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
            Log::error($msgDetails["entityName"] . ' ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }

    public function updateEvent($eventId)
    {
        $eventUri = 'https://dev.cms.mypartypokerlive.com/en/api/web/2.3/events/event_only/' . $eventId;//.'?softdeleteable=0';
        $apiResource = $this->guzzle->get($eventUri);

        $now = Carbon::now();

        Log::info($eventId . ' EVENT ID');
        if ('200' == $apiResource->getStatusCode()) {
            $event = Event::query()->find($eventId);

            $eventData = json_decode($apiResource->getBody());

            $country = Country::query()->where('code', $eventData->event->eventCountry)->first();
            if (!$country) {
                Log::info('[x] Unprocessable COUNTRY');

            }
            if (is_null($eventData->event->deletedAt)) {
                if (is_null($event)) {
                    $event = new Event();
                    $event->id = $eventId;
                }
                $event->title = $eventData->event->eventName;
                $event->description = $eventData->event->eventUpcomingAbout;
                $event->buy_in = (float)$eventData->event->eventBuyIn;
                $event->reg_free = $eventData->event->eventRegFee;
                $event->fund = (float)$eventData->event->eventUpcomingPrizepool;
                $event->slug = $eventData->event->eventNameSlug;
                $event->logo = $eventData->event->eventLogoBg;
                $event->country_id = $country ? $country->id : null;
                $event->currency = $eventData->event->eventCurrency;
                $event->venue_id = $eventData->event->eventVenueId;
                $event->venue_name = $eventData->event->eventVenueName;
                $event->date_end = Carbon::parse($eventData->event->eventEndDate);
                $event->date_start = Carbon::parse($eventData->event->eventStartDate);
                $event->status = $now->gte(Carbon::parse($eventData->event->eventStartDate))? Event::STATUS_CLOSED : Event::STATUS_ACTIVE;

                Log::info($now->gte(Carbon::parse($eventData->event->eventStartDate)) . 'status event');
                Log::info($now . 'NOW');
                Log::info(Carbon::parse($eventData->event->eventStartDate) . 'START DAY');
                $this->updateImage($event);
                $event->save();



                $this->updateVenue($eventData->event);

                if (count($eventData->event->schedules) > 0) {
                    foreach ($eventData->event->schedules as $schedule) {
                        $this->updateSchedule($schedule->id);

                    }
                }
            }
        }
    }

    public function updateVenue($event){
        $key = '@type'; // костыль для ключа @type

        $venue = Venue::query()->where('id', $event->eventVenueId)->first();
        $country = Country::query()->where('code', $event->eventVenueAddressArray->addressCountry)->first();

        Log::info($event->eventVenueAddressArray->addressCountry);
        if (is_null($venue)) {
            $venue = new Venue();
            $venue->id = $event->eventVenueId;
        }
        $venue->event_id            = $event->id;
        $venue->country_id          = $country ? $country->id: null;
        $venue->title               = $event->eventVenueName;
        $venue->adress_type         = $event->eventVenueAddressArray->$key;
        $venue->street              = $event->eventVenueAddressArray->streetAddress;
        $venue->locality            = $event->eventVenueAddressArray->addressLocality;
        $venue->postal_code         = $event->eventVenueAddressArray->postalCode;
        $venue->address_region      = $event->eventVenueAddressArray->addressRegion;
        $venue->venue_address       = $event->eventVenueAddressStr;
        $venue->venue_longitude     = $event->eventVenueLongitude;
        $venue->venue_latitude      = $event->eventVenueLatitude;

        $venue->save();
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
            Log::info('[x] Unprocessable entity not event');
            return false;
        }

        if (is_null($subEvent)) {
            $subEvent = new SubEvent();
            $subEvent->id = $ppSubEvent->schedule->id;
        }


        $subEvent->event_id = $ppSubEvent->schedule->event_id;
        $subEvent->title = $ppSubEvent->schedule->scheduleTitle;
        $subEvent->fund = isset($ppSubEvent->schedule->schedulePrizePool)? (float)$ppSubEvent->schedule->schedulePrizePool: null;
        $subEvent->buy_in = (float)$ppSubEvent->schedule->scheduleBuyIn;
        $subEvent->date_start = isset($ppSubEvent->schedule->firstDayDate)?$ppSubEvent->schedule->firstDayDate:null;
        $subEvent->date_end = isset($ppSubEvent->schedule->lastDayDate)?$ppSubEvent->schedule->lastDayDate:null;
        $subEvent->save();

        if (count($ppSubEvent->schedule->days)>0){
            foreach ($ppSubEvent->schedule->days as $ppDay){

                $this->updateDay($ppDay->id);

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
        $event = Event::query()->where('id', $ppDay->day->event_id)->first();

        if ($subEvent && $event){
            Log::info('[x] Unprocessable entity. DayId: ' . $ppDay->day->schedule_id
                . '. Do no found sub_event: ' . $subEvent->id
                . '. Do no found event: ' . $ppDay->day->event_id);
            return false;
        }

        $flight->sub_event_id = $ppDay->day->schedule_id;
        $flight->title = $ppDay->day->day . $ppDay->day->flight;
        $flight->type = $ppDay->day->type == 'live' ? Flight::TYPE_LIVE : Flight::TYPE_ONLINE;
        $flight->date = Carbon::parse($ppDay->day->date);
        $flight->flight = $ppDay->day->flight;
        $flight->day = $ppDay->day->day;
        $flight->event_id= $subEvent ? $subEvent->event->id : $ppDay->day->event_id;
        $flight->save();

    }

    public function updateImage(Event $event){
        \Cloudinary::config([
            "cloud_name" => config('cloudinary.cloudName'),
            "api_key" => config('cloudinary.apiKey'),
            "api_secret" => config('cloudinary.apiSecret')
        ]);
        $url = $event->main_image;
        $client = new Client();
        $request = $client->get($url);
        $response = $request->getBody()->getContents();
        $fileName = ImageAttachment::generateFileName('png');
        $filePath = ImageAttachment::generateFileFolder($fileName);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
        file_put_contents($filePath.$fileName, $response);
        $data = [
            'original_name' => $fileName,
            'code' => $fileName,
            'type' => ImageAttachment::TYPE_USER_AVATAR
        ];
        $newImage = new ImageAttachment($data);
        echo $filePath.$fileName;
        $newImage->save();
        $event->image_id = $newImage->id;

    }
}
