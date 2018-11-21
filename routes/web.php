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

Route::group(['middleware' => 'guest'], function(){
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::post('/password/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

});

Route::group(['middleware' => 'auth'], function(){
    Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('/profile/avatar', 'ImageAttachmentController@upload');
});


Route::get('/dealer/login', 'PageController@app');
Route::get('/dealer/logout', 'PageController@app');
Route::get('/dealer', 'PageController@dealer')->name('dealer');
Route::group(['middleware' => 'admin'], function() {

});

Route::get('{any}', 'PageController@app')->where(['any' => '.*'])->name('index');


Route::get('desktop/all', 'PageController@desktop');
