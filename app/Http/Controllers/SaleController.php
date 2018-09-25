<?php
/**
 * Created by PhpStorm.
 * User: j30att
 * Date: 25.09.18
 * Time: 18:13
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SaleController
{
    public function index(Request $request){
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.sale.sale');
    }
    public function newSale(Request $request){
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.sale.new-sale');
    }
    public function activeSale(Request $request){
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.sale.sale-active');
    }
    public function closeSale(Request $request){
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice.'.sale.sale-close');
    }
}