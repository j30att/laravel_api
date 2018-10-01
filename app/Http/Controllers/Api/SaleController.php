<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $filter = $request->get('filter');


        if ($user != null){
            if ($filter == null){
                $saleActive     = Sale::query()->where(['status'=> Sale::SALE_ACTIVE, 'user_id'=>$user->id])->get();
                $saleCanceled   = Sale::query()->where(['status'=> Sale::SALE_CLOSED, 'user_id'=>$user->id])->get();

                return response()->json([
                    'data'=> [
                    'active'   => SaleResource::collection($saleActive),
                    'canceled' => SaleResource::collection($saleCanceled)
                    ]
                ]);
            } else {
                $sale = Sale::query()->where(['status'=> $filter, 'user_id'=>$user->id])->get();
                return SaleResource::collection($sale);
            }

        } else {
            return abort(403);
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

        //todo: validate data


        $data = $request->all();
        $sale = Sale::create($data);

        return response(json_encode(['status'=>1]));

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
