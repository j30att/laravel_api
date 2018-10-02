<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'id'        => $this->id,
            'title'     => $this->title,
            'status'    => $this->status,
            'markup'    => $this->markup,
            'share'     => $this->share,
            'amount'    => $this->amount,
            'subevent' => new SubEventResource($this->subevent),
        ];
        return parent::toArray($request);
    }
}
