<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 24.09.18
 * Time: 22:49
 */

namespace App\Http\Controllers;


class BidsController
{
    public function index(){
        return view('bids.index');
    }
}