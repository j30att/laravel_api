<?php

namespace App\Http\Controllers;

use App\Http\Services\PPInteraction;
use App\Models\Bid;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function app(Request $request){
//        $bid = Bid::query()->find('75');
//        PPInteraction::bidPlace($bid);
        return view('layouts.main');
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }

    public function desktop(Request $request) {
        return view('desktop.bids.index');
    }
}
