<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix'=>'bids'], function (){
    Route::get('/', 'BidsController@index')->name('bids');
    Route::get('/filter', 'BidsController@filter')->name('bids-filter');
});





Route::get('/', 'HomeController@index');
Route::get('/signin', 'Auth\LoginController@showSignin')->name('signin');
Route::get('/login/register', function(){
    return view('login.register');
});

Route::group(['middleware' => 'auth','prefix' => 'profile'], function(){
    Route::get('/', 'HomeController@profile')->name('profile');
    Route::get('/edit', function () {
        return view('profile.edit');
    });
});

Route::group(['prefix' => 'events'], function() {
    Route::get('/', 'EventsController@index')->name('events');
    Route::get('/all', 'EventsController@eventsList')->name('all-events');
    Route::get('/{event}', 'EventsController@event')->name('event');
});



Route::group(['prefix'=>'sale'], function (){
    Route::get('/', 'SaleController@index')->name('sale');
    Route::get('/new', 'SaleController@newSale')->name('new-sale');
    Route::get('/active', 'SaleController@activeSale')->name('sale-active');
    Route::get('/close', 'SaleController@closeSale')->name('sale-close');
});


/*

Route::get('/bids/matched', function(){
    return view('mobile.bids.parts.matched');
});
*/

Route::get('/place-a-bit', function(){
    return view('mobile.bids.place_a_bit.index');
})->name('place-a-bit');




/*Route::get('/login', function(){
    return view('login.index');
})->name('login');*/
Route::get('/login/personal-information', function(){
    return view('login.personal-inf');
});

Route::get('/login/account-information', function(){
    return view('login.account-inf');
});
Route::get('/login/check-email', function(){
    return view('login.check-email');
});
Route::get('/login/privacy', function(){
    return view('login.data-privacy');
})->name('terms');
Route::get('/login/privacy-politic', function(){
    return view('login.privacy');
})->name('privacy');

Route::get('/login/new-email', function(){
    return view('login.new-email');
});


//events rout

Route::get('/login/userproftest', 'ProfileController@showProfile');
Route::post('/login/userproftest', 'ProfileController@editProfile');

//Route::post('login', 'AuthController@loginUser')->name('login');

Route::get('/filters', function(){
    return view('filters.filter');
})->name('filters');

Route::get('/region-filter', function(){
    return view('filters.region');
})->name('region-filter');

Route::get('/event-filter', function(){
    return view('filters.event');
})->name('event-filter');





$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('login/register', 'Auth\RegisterController@register');
// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');









