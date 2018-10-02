<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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
        $sale = null;




        if (array_key_exists('user_id', $filter)) {
            if ($filter['user_id'] != $user->id) {
                App::abort(403);
            }
        }


        if (array_key_exists('page', $filter)) {
            if (array_key_exists('status', $filter)) {
                unset($filter['page']);
                $sale = Sale::query()
                    ->where($filter)
                    ->with('creator')
                    ->with('subevent')
                    ->with('event')
                    ->get();


            }else{
                if ($filter['page'] == 'sales') {
                    $saleActive = Sale::query()->where(['status' => Sale::SALE_ACTIVE, 'user_id' => $user->id])->get();
                    $saleCanceled = Sale::query()->where(['status' => Sale::SALE_CLOSED, 'user_id' => $user->id])->get();

                    return response()->json([
                        'data' => [
                            'active' => SaleResource::collection($saleActive),
                            'canceled' => SaleResource::collection($saleCanceled)
                        ]
                    ]);
                }
            }
        } else{
            $sale = Sale::query()
                ->where($filter)
                ->with('creator')
                ->with('subevent')
                ->with('event')
                ->get();
        }
        return SaleResource::collection($sale);



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

        //todo: validate data


        $data = $request->all();
        $sale = Sale::create($data);

        return response(json_encode(['status' => 1]));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $sale = Sale::query()->where('id', $id)->with(['bids'=> function ($query){
            $query->where('status',1);

        }])->first();
        return new SaleResource($sale);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Sale::query()->where('id', $id)->update($request->all());
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
