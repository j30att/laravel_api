<?php

namespace App\Http\Resources\Events;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Event $this */
        return [
            'id' => $this->id,
            'image' => $this->image ? $this->image->url : $this->main_image ,
            'title' => $this->title,
            'fund' => $this->fund,
            'period' => $this->period,
            'country_id' => $this->country->id,
            'country_name' => $this->country->name,
        ];
        //return parent::toArray($request);
    }
}
