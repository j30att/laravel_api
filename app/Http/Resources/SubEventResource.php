<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubEventResource extends JsonResource
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
            'title'         => $this->title,
            'fund'          => $this->fund,
            'buy_in'        => $this->buy_in,
            'date'          => $this->formatted_date,
            'short_date'    => $this->formatted_short_date

        ];
        return parent::toArray($request);
    }
}
