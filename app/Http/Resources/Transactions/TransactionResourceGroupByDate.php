<?php

namespace App\Http\Resources\Transactions;

use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResourceGroupByDate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Transaction $this */
        return [
                'id' => $this->id,
                'date' => $this->date,
                'received' => $this->received,
                'event' => $this->eventName,
                'subevent' => $this->subeventName,
                'amount' => $this->type == Transaction::TYPE_BID_REWARDED ? '+'.$this->amount : '-'.$this->amount,
                'balance' => $this->balance,
                'status' => $this->status,
                'verbalStatus' => $this->verbalStatus,
        ];
    }
}
