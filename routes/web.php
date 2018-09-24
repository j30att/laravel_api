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
Route::get('/', function(){
    return view('bids.index');
})->middleware('auth');


Route::group(['middleware' => 'auth','prefix' => 'profile'], function(){
    Route::get('/', 'HomeController@profile')->name('profile');
    Route::get('/edit', function () {
        return view('profile.edit');
    });
});





Route::get('/bids', function(){
    return view('bids.index');
});
Route::get('/bids/matched', function(){
    return view('bids.parts.matched');
});
/*Route::get('/login', function(){
    return view('login.index');
})->name('login');*/
Route::get('/login/personal-information', function(){
    return view('login.personal-inf');
});
Route::get('/login/register', function(){
    return view('login.register');
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
Route::get('/signin', function(){
    return view('login.signin');
})->name('signin');

//events rout
Route::get('/events', 'HomeController@events')->name('events');

Route::get('/all-events', 'HomeController@eventsList')->name('all-events');

Route::get('/single-events', function(){
    return view('events.single');
})->name('single-events');

Route::get('/login/userproftest', 'ProfileController@showProfile');
Route::post('/login/userproftest', 'ProfileController@editProfile');

//Route::post('login', 'AuthController@loginUser')->name('login');

Route::get('/place-a-bit', function(){
    return view('bids.place_a_bit.index');
})->name('place-a-bit');



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







Route::get('/home', 'HomeController@index')->name('home');


