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

    Route::post('/sales/lowest', 'Api\SaleController@lowestSales');
    Route::post('/sales/closing', 'Api\SaleController@closingSales');
    Route::post('/sales/subevent', 'Api\SaleController@subeventSales');
    Route::post('/sales/closing-soon', 'Api\SaleController@closingSoonSalesAuth');
    Route::post('/sales/filtered', 'Api\SaleController@filteredSales');
    Route::apiResource('/sale', 'Api\SaleController');

    Route::post('/events/filtered', 'Api\EventController@filteredEvents');
    Route::get('/events/get-filters', 'Api\EventController@getFilters');
    Route::get('/events/main', 'Api\EventController@mainEvents');
    Route::apiResource('/events', 'Api\EventController');
    Route::apiResource('subevents', 'Api\SubEventController');


    Route::post('/countries', 'Api\CountryController@getCountries');


});

Route::group(['middleware' => 'auth'], function (){
    Route::post('/sales/my',        'Api\SaleController@mySales');
    Route::post('/sales/my/active', 'Api\SaleController@myFilterSales');
    Route::post('/sales/my/closed', 'Api\SaleController@myFilterSales');

    Route::post('/sales/my/update/', 'Api\SaleController@myUpdateSales');
    Route::post('/sales/my/aplly/', 'Api\SaleController@applayBidToMySale');

    Route::post('/bids/my',             'Api\BidController@myBids');
    Route::post('/bids/my/matched',     'Api\BidController@myFilterBids');
    Route::post('/bids/my/unmatched',   'Api\BidController@myFilterBids');
    Route::post('/bids/my/settled',     'Api\BidController@myFilterBids');
    Route::post('/bids/my/canceled',    'Api\BidController@myFilterBids');

    Route::post('/bids/my/store', 'Api\BidController@myStoreBid');


    Route::post('/dealer/users', 'Api\DealerController@usersList');
    Route::post('/dealer/events', 'Api\DealerController@eventsList');
    Route::post('/dealer/profile', 'Api\DealerController@profileDetail');
    Route::post('/dealer/event/detail', 'Api\DealerController@eventDetail');

    Route::post('/dealer/currency', 'Api\DealerController@currencyList');

    Route::post('/dealer/result', 'Api\DealerController@resultSale');

});


