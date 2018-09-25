<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 24.09.18
 * Time: 22:49
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class BidsController
{
    public function index(Request $request){

        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.bids.index');
    }
}