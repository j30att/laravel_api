<?php

namespace App\Http\Resources\Events;

use App\Http\Resources\Sales\SaleInvestResource;
use App\Http\Resources\SubEventResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailResource extends JsonResource
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
            'id'         => $this->resource->id,
            'title'      => str_limit($this->resource->title, 20),
            'date'       => $this->formatted_date,
            'fund'       => $this->fund,
            'buy_in'     => $this->buy_in,
            'period'     => $this->period,
            'subevents'  => SubEventResource::collection($this->subEvents),
            'sales'      => SaleInvestResource::collection($this->sales),
            'image'        => $this->main_image
        ];
    }
}
