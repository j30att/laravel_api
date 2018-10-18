<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BidResource;
use App\Http\Resources\Bids\BidsInvestResource;
use App\Http\Services\BetsManageService;
use App\Models\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myBids(Request $request){
        $user = Auth::user();

        if ($request->get('user_id') != $user->id) App::abort(401);

        $bidsMutched    = Bid::query()->where(['status'=> Bid::BIDS_MATCHED, 'user_id'=>$user->id])->with('sale.subevent.event')->get();
        $bidsUnmutched  = Bid::query()->where(['status'=> Bid::BIDS_UNMATCHED, 'user_id'=>$user->id])->with('sale.subevent.event')->get();
        $bidsSetted     = Bid::query()->where(['status'=> Bid::BIDS_SETTLED, 'user_id'=>$user->id])->with('sale.subevent.event')->get();
        $bidsCanceled   = Bid::query()->where(['status'=> Bid::BIDS_CANCELED, 'user_id'=>$user->id])->with('sale.subevent.event')->get();

        return response()->json(['data' =>[
            'matched'   => BidResource::collection($bidsMutched),
            'unmatched' => BidResource::collection($bidsUnmutched),
            'settled' => BidResource::collection($bidsSetted),
            'canceled' => BidResource::collection($bidsCanceled)]
        ]);

    }

    public function myFilterBids(Request $request){
        $user = Auth::user();

        if ($request->get('user_id') != $user->id) App::abort(401);
        $filter = $request->all();

        $bids = Bid::query()->where($filter)
            ->with('sale.subevent.event')
            ->with('investor')
            ->get();
        return BidResource::collection($bids);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function myStoreBid(Request $request)
    {
        $data = $request->get('bid');
        $bid = Bid::create($data);
        $bid = BetsManageService::linkBidToSale($bid);


        $highest = Bid::query()
            ->where('sale_id', $bid->sale_id)
            ->where('status', Bid::BIDS_UNMATCHED)
            ->orderBy('share', 'desc')->limit(3)->get();
        $matched = Bid::query()
            ->where('user_id', $bid->user_id)
            ->where('sale_id', $bid->sale_id)
            ->where('status', Bid::BIDS_MATCHED)->get();
        $unmatched = Bid::query()
            ->where('user_id', $bid->user_id)
            ->where('sale_id', $bid->sale_id)
            ->where('status', Bid::BIDS_UNMATCHED)->get();



        return json_encode([ 'status'=> 1, 'bids'=> [
            'highest'   => BidsInvestResource::collection($highest),
            'matched'   => BidsInvestResource::collection($matched),
            'unmatched' => BidsInvestResource::collection($unmatched)
            ]]);
    }




    public function index(Request $request)
    {
    /*    $user = Auth::user();
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
*/

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
