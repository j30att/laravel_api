<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 24.09.18
 * Time: 22:49
 */

namespace App\Http\Controllers;


use App\Models\Bid;
use App\Models\BidResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidsController
{
    public function index(Request $request){

        $typeDevice = $request->get('typeDevice');

        return view($typeDevice.'.bids.index');
    }

    public function filter(Request $request){
        $typeDevice = $request->get('typeDevice');

        return view($typeDevice.'.bids.filter');
    }
}
