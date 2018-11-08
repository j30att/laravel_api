<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function app(Request $request){
        dd($request->all());
        return view('layouts.main');
    }
    public function dealer(Request $request){
        return view('layouts.static');
    }
}
