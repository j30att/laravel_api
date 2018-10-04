<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([/*'middleware' => 'auth'*/], function(){
    Route::apiResource('bids', 'Api\BidController');
    Route::apiResource('sale', 'Api\SaleController');
    Route::apiResource('events', 'Api\EventController');
    Route::apiResource('subevents', 'Api\SubEventController');




});

Route::group(['middleware' => 'auth'], function (){
    Route::post('/sales/my',        'Api\SaleController@mySales');
    Route::post('/sales/my/active', 'Api\SaleController@myFilterSales');
    Route::post('/sales/my/closed', 'Api\SaleController@myFilterSales');

    Route::post('/bids/my',             'Api\BidController@myBids');
    Route::post('/bids/my/matched',     'Api\BidController@myFilterBids');
    Route::post('/bids/my/unmatched',   'Api\BidController@myFilterBids');
    Route::post('/bids/my/settled',     'Api\BidController@myFilterBids');
    Route::post('/bids/my/canceled',    'Api\BidController@myFilterBids');
});

Route::post('/sales/lowest', 'Api\SaleController@lowestSales');
Route::post('/sales/closing', 'Api\SaleController@closingSales');
Route::post('/sales/subevent', 'Api\SaleController@subeventSales');
