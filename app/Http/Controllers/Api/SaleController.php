<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\Sales\SaleInvestResource;
use App\Http\Resources\SaleResource;
use App\Models\Bid;
use App\Models\Sale;
use Carbon\Carbon;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function closingSoonSalesAuth(Request $request)
    {
        $user = Auth::user();

        if ($user == null) {
            return $this->closingSoonSales();
        } else {
            if ($user->id != $request->get('user_id')) $this->closingSoonSales();
        }

        $sales = Sale::query()
            ->where('status', SALE::SALE_ACTIVE)
            ->with('creator')
            ->with('event')
            ->with(['bids_matched' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->with(['bids_unmatched' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->get()
            ->sortBy('event.date_end');

        return SaleInvestResource::collection($sales);
    }

    public function closingSoonSales()
    {
        $sales = Sale::query()
            ->where('status', SALE::SALE_ACTIVE)
            ->with('creator')
            ->with('event')
            ->with('bids_highest')
            ->get()
            ->sortBy('event.date_end');

        return SaleInvestResource::collection($sales);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mySales(Request $request)
    {
        $user = Auth::user();
        if ($request->get('user_id') != $user->id) App::abort(401);

        $limit = $request->get('limit');

        $saleActive = Sale::query()->where(['status' => Sale::SALE_ACTIVE, 'user_id' => $user->id])->limit($limit)->get();
        $saleCanceled = Sale::query()->where(['status' => Sale::SALE_CLOSED, 'user_id' => $user->id])->limit($limit)->get();
        return response()->json([
            'data' => [
                'active' => SaleResource::collection($saleActive),
                'closed' => SaleResource::collection($saleCanceled)
            ]
        ]);

    }

    /**
     * Show the sale of authorized user by filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function myFilterSales(Request $request)
    {
        $user = Auth::user();
        if ($request->get('user_id') != $user->id) App::abort(401);
        $filter = $request->all();
        $sale = Sale::query()
            ->where($filter)
            ->with('creator')
            ->with('subevent')
            ->with('event')
            ->get();

        return SaleResource::collection($sale);
    }

    /**
     * Show the sale order_by markup.
     *
     * @return \Illuminate\Http\Response
     */
    public function lowestSales()
    {
        $sale = Sale::query()
            ->with('creator')
            ->with('subevent')
            ->with('event')
            ->orderBy('markup')
            ->get();
        return SaleResource::collection($sale);
    }

    /**
     * Show the sale order_by date_end in subevents.
     *
     * @return \Illuminate\Http\Response
     */
    public function closingSales()
    {
        $sale = Sale::query()
            ->with('creator')
            ->with('subevent')
            ->with('event')
            ->get()->sortBy('event.date_start');


        return SaleResource::collection($sale);
    }

    /**
     * Show the sale for subevent.
     *
     * @return \Illuminate\Http\Response
     */
    public function subeventSales(Request $request)
    {
        $filter = $request->all();
        $sale = Sale::query()->where($filter)->with('subevent')->get();
        return SaleResource::collection($sale);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filteredSales(Request $request)
    {
        $query = Sale::query();
        $filter = $request->get('filter');

        if ($filter) {
            if (isset($filter['status'])) {
                $query->where('status', $filter['status']);
            }
        }

        return SaleResource::collection($query->get());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function myUpdateSales(Request $request)
    {
        $data = $request->get('sale');
        $sale = Sale::query()->find($data['id']);
        $sale->share = $data['share'];
        $sale->markup = $data['markup'];
        $sale->amount = $data['amount'];
        $sale->save();
    }

    public function applayBidToMySale (Request $request){

        $data = $request->get('bid');

        $bid = Bid::query()->find($data['bid']['id']);

        $bid->markup = $data['bid']['markup'];
        $bid->share = $data['bid']['share'];
        $bid->amount = $data['bid']['amount'];
        $bid->status = Bid::BIDS_MATCHED;
        $bid->save();


        $sale = Sale::query()
            ->with('creator')
            ->with('subevent')
            ->with('event')
            ->find($data['sale_id']);

        $sale->markup = $data['bid']['markup'];
        $sale->share = $data['bid']['share'];
        $sale->amount = $data['bid']['amount'];
        $sale->save();


        return  new SaleResource($sale);

    }


    public function index(Request $request)
    {
        dd('тут ничего нету');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->get('sale');
        $sale = Sale::create($data);
        return response(json_encode(['status' => 1, 'data' => $sale]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
