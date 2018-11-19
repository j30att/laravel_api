<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function app(Request $request){
        return view('layouts.main');
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }

    public function desktop(Request $request) {
        return view('desktop.bids.index');
    }
}
