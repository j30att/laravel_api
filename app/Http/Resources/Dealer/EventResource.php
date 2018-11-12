<?php

namespace App\Http\Resources\Dealer;

use App\Http\Resources\SubEventResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'id'            => $this->id,
            //'title'         => str_limit($this->resource->title, 20),
            'title'         => $this->resource->title,
            'date'          => $this->formatted_date,
            'fund'          => $this->fund,
            'period'        => $this->period,
            'buy_in'        => $this->buy_in,
            'date_start'    => $this->formatted_start_date,
            'date_end'      => $this->formatted_end_date,
            'date_close_in' => $this->close_in,
            'sales'         => SaleResource::collection($this->sales),
            'subevents'     => $this->subevents,

        ];
    }
}
