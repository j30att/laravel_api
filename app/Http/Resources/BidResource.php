<?php

namespace App\Http\Resources;

use App\Http\Resources\Users\UserInvestResource;
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
            'investor' => new UserInvestResource($this->investor),
            'sale'=> $this->sale,
            'markup'=> $this->markup,
            'share'=> $this->share,
            'amount'=> $this->amount,
            'creator'=> $this->sale->creator,
            //'subevent'=> new SubEventResource($this->sale->subevent)

        ];
        //return parent::toArray($request);
    }
}
