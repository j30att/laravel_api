<?php

namespace App\Http\Resources\Dealer;

use App\Http\Resources\Users\UserInvestResource;
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
            'id'            => $this->id,
            'placed'        => $this->placed,
            'amount'        => $this->amount,
            'markup'        => $this->markup,
            'share'         => $this->share,
            'bids'          => $this->bids,
            'sub_event_id'  => $this->sub_event_id,
            'status'        => $this->status,
            'creator'       => new UserInvestResource($this->creator),
            'subevent'      => $this->subevent,
            'buy_in'        => $this->buy_in,
            'fund'          => $this->fund,
        ];
    }
}
