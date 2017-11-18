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
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('logout', function () {
        \Auth::logout();
        return redirect(route('login'));
    })->name('logout');
   Route::get('/my/account', 'AccountController@index')->name('account');

    Route::get('/my/account/show', 'CustomerController@index');
    Route::post('/my/account/newCustomer', 'CustomerController@newCustomer');
    Route::get('getUpdate', 'CustomerController@getUpdate');
    Route::put('/my/account/newCustomer', 'CustomerController@newUpdate');
    Route::post('/my/account/deleteCustomer', 'CustomerController@deleteCustomer');
});

