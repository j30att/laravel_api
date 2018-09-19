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

Route::get('/profile', function () {
    return view('profile.view');
});
Route::get('/profile/edit', function () {
    return view('profile.edit');
});

Route::get('/bids', function(){
    return view('bids.index');
});
Route::get('/bids/matched', function(){
    return view('bids.parts.matched');
});
Route::get('/login', function(){
    return view('login.index');
});
Route::get('/login/personal-information', function(){
    return view('login.personal-inf');
});
Route::get('/login/account-information', function(){
    return view('login.account-inf');
});
Route::get('/login/check-email', function(){
    return view('login.check-email');
});
Route::get('/login/data-privacy', function(){
    return view('login.data-privacy');
});
Route::get('/login/new-email', function(){
    return view('login.new-email');
});
