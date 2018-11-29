<?php

namespace App\Http\Controllers;

use App\Http\Services\PPInteraction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function app(Request $request){
        $linkUrl = config('api.linkHost').'/'.config('api.linkLang').'/VC/login-staking.html?redirect_URI='.config('api.linkRedirect');
        $user = Auth::user();
        if($user) {
            $user = User::query()->where('id', $user->id)->with('ppUser')->first();
        }

        return view('layouts.main', ['linkUrl' => $linkUrl, 'user'=>$user]);
    }

    public function dealer(Request $request){
        return view('layouts.static');
    }

    public function desktop(Request $request) {
        return view('desktop.bids.index');
    }
}
