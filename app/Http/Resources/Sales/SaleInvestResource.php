<?php

namespace App\Http\Resources\Sales;

use App\Http\Resources\Bids\BidsGroupResource;
use App\Http\Resources\Events\EventsInvestResource;
use App\Http\Resources\Users\UserInvestResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleInvestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $now = Carbon::now();
        return [
            'id'        => $this->id,
            'status'    => $this->status,
            'markup'    => $this->markup,
            'share'     => $this->share,
            'amount'    => $this->amount,
            'event'     => new EventsInvestResource($this->event),
            'creator'   => new UserInvestResource($this->creator),
            'bids'      => new BidsGroupResource($this)
            //'time'      => $now->diff
        ];

    }
}
