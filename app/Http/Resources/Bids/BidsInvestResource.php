<?php

namespace App\Http\Resources\Bids;

use Illuminate\Http\Resources\Json\JsonResource;

class BidsInvestResource extends JsonResource
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
            'share'  => $this->share,
            'markup' => $this->markup,
            'amount' => $this->amount,
            'status' => $this->status
        ];
    }
}
