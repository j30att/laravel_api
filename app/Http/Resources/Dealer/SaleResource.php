<?php

namespace App\Http\Resources\Dealer;

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

            'placed'        => $this->placed,
            'amount'        => $this->amount,
            'markup'        => $this->markup,
            'share'         => $this->share,
            'bids'          => $this->bids,
            'sub_event_id'  => $this->sub_event_id,
            'status'        => $this->status,
            'creator'       => $this->creator,
        ];
    }
}
