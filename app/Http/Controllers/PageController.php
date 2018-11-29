<?php

namespace App\Http\Controllers;

use App\Http\Services\PPInteraction;
use App\Models\Bid;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function app(Request $request){
        $linkUrl ='https://'.config('api.linkHost').'/'.config('api.linkLang').'/VC/login-staking.html?redirect_URI='.config('api.linkRedirect');
        return view('layouts.main', ['linkUrl' => $linkUrl]);
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }

    public function desktop(Request $request) {
        return view('desktop.bids.index');
    }
}
