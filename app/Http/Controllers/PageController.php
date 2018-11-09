<?php

namespace App\Http\Controllers;

use App\Http\Services\CloudderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function app(Request $request){

        //CloudderService::upload();

        return view('layouts.main');
    }
    public function dealer(Request $request){
        return view('layouts.static');
    }
}
