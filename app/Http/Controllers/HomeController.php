<?php

namespace App\Http\Controllers;

use App\Models\Event;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.bids.index', compact('user'));
    }

    public function profile(Request $request){
        $user = Auth::user();
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.profile.view', compact('user'));
    }

}

