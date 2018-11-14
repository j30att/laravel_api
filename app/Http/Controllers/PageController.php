<?php

namespace App\Http\Controllers;

use App\Http\Services\BetsManageService;
use App\Http\Services\PPInteraction;
use App\Http\Services\PPValidate;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function app(Request $request){

       $result = Result::query()->find(2);
       BetsManageService::manageWins($result);




        return view('layouts.main');
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }
}
