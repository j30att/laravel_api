<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BidResource;
use App\Models\BidResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BidResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter = $request->get('filter');
        $user = Auth::user();

        if ($filter){
            $bids = BidResponse::query()->where(['status'=> $filter, 'investor_id'=>$user->id])->get();
            return BidResource::collection($bids);
        } else{
            $bidsMutched = BidResponse::query()->where(['status'=> BidResponse::BIDS_RESPONSE_MATCHED, 'investor_id'=>$user->id])->get();
            $bidsUnmutched = BidResponse::query()->where(['status'=> BidResponse::BIDS_RESPONSE_UNMATCHED, 'investor_id'=>$user->id])->get();
            $bidsSetted = BidResponse::query()->where(['status'=> BidResponse::BIDS_RESPONSE_SETTLED, 'investor_id'=>$user->id])->get();
            $bidsCanceled = BidResponse::query()->where(['status'=> BidResponse::BIDS_RESPONSE_CANCELED, 'investor_id'=>$user->id])->get();
            //return BidResponseResource::collection($bids);'
            return response()->json([
                'matched'   => BidResource::collection($bidsMutched),
                'unmatched' => BidResource::collection($bidsUnmutched),
                'settled' => BidResource::collection($bidsSetted),
                'canceled' => BidResource::collection($bidsCanceled)
            ]);
        }
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
