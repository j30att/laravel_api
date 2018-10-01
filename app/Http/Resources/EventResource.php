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
            'id'=> $this->resource->id,
            'title' => $this->resource->title,
            'subevents' => $this->resource->subEvents,
            ];
        return parent::toArray($request);
    }
}
