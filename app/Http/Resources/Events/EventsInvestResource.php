<?php

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsInvestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'         => $this->title,
            'buy_in'        => $this->buy_in,
            'fund'          => $this->fund,
            'date_start'    => $this->formatted_start_date
        ];

    }
}
