<?php

namespace App\Http\Resources;

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
            'id'        => $this->resource->id,
            'title'     => str_limit($this->resource->title, 20),
            'date'      => $this->formatted_date,
            'fund'      => $this->fund,
            'subevents' => $this->resource->subEvents,
            ];
        return parent::toArray($request);
    }
}
