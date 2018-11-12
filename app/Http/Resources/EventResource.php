<?php

namespace App\Http\Resources;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id'            => $this->resource->id,
            //'title'         => str_limit($this->resource->title, 20),
            'title'         => $this->resource->title,
            'date'          => $this->formatted_date,
            'fund'          => $this->fund,
            'buy_in'        => $this->buy_in,
            'subevents'     => $this->resource->subEvents,
            'date_start'    => $this->formatted_start_date,
            'date_end'      => $this->formatted_end_date,
            'date_close_in' => $this->close_in

        ];
    }
}
