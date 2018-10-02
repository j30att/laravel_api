<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BidResource;
use App\Models\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->all();


        if(array_key_exists('status', $filter)){
                $bids = Bid::query()->where($filter)
                    ->with('sale.subevent.event')
                    ->with('investor')
                    ->get();
            return BidResource::collection($bids);
        }
        $bidsMutched    = Bid::query()->where(['status'=> Bid::BIDS_MATCHED])->with('sale.subevent.event')->get();
        $bidsUnmutched  = Bid::query()->where(['status'=> Bid::BIDS_UNMATCHED])->with('sale.subevent.event')->get();
        $bidsSetted     = Bid::query()->where(['status'=> Bid::BIDS_SETTLED])->with('sale.subevent.event')->get();
        $bidsCanceled   = Bid::query()->where(['status'=> Bid::BIDS_CANCELED])->with('sale.subevent.event')->get();

        return response()->json(['data' =>[
            'matched'   => BidResource::collection($bidsMutched),
            'unmatched' => BidResource::collection($bidsUnmutched),
            'settled' => BidResource::collection($bidsSetted),
            'canceled' => BidResource::collection($bidsCanceled)]
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
