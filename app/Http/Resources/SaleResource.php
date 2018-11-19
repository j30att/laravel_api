<?php

namespace App\Http\Resources;

use App\Models\Sale;
use function Couchbase\defaultDecoder;
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
            'title'         => $this->title,
            'status'        => $this->status,
            'markup'        => $this->markup,
            'share'         => $this->share,
            'amount'        => $this->amount,
            'event'         => new EventResource($this->event),
            'subevent'      => new SubEventResource($this->subevent),
            'bids'          => $this->bids,
            'bids_share'    => $this->share_sold,
            'amount_raised' => $this->amount_raised,
            'average_murkup' => $this->average_markup,
            'creator'       => $this->creator,
        ];


        //return parent::toArray($request);
    }
}
