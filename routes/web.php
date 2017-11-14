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

Route::get('/', 'CustomerController@index');
Route::post('/newCustomer', 'CustomerController@newCustomer');
Route::get('/getUpdate', 'CustomerController@getUpdate');
Route::put('/newCustomer', 'CustomerController@newUpdate');
Route::post('/deleteCustomer', 'CustomerController@deleteCustomer');
