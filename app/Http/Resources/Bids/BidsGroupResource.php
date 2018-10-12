<?php

namespace App\Http\Resources\Bids;

use Illuminate\Http\Resources\Json\JsonResource;

class BidsGroupResource extends JsonResource
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
            'highest'   => BidsInvestResource::collection($this->bids_highest),
            'matched'   => BidsInvestResource::collection($this->bids_matched),
            'unmatched' => BidsInvestResource::collection($this->bids_unmatched)
        ];
    }
}
