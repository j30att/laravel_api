<?php

namespace App\Http\Controllers;

use App\Http\Services\CloudderService;
use App\Http\Services\PPValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function app(Request $request){
        return view('layouts.main');
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }
}
