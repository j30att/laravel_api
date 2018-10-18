<?php

namespace App\Http\Resources;

use App\Http\Resources\Sales\SaleInvestResource;
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
            'sales'      => SaleInvestResource::collection($this->sales)
        ];
    }
}
