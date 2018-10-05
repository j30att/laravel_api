<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'status' => $this->status,
            'investor' => $this->investor,
            'sale'=> $this->sale,
            'markup'=> $this->markup,
            'share'=> $this->share,
            'amount'=> $this->amount,
            'subevent'=> new SubEventResource($this->sale->subevent)

        ];
        return parent::toArray($request);
    }
}
