<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

get('/seller/index', 'SellerController@index');
get('/seller/create', 'SellerController@create');
get('/seller/edit/{id}', 'SellerController@edit');
get('/seller/delete/{id}', 'SellerController@destroy');

post('/seller/store', 'SellerController@store');
post('/seller/update', 'SellerController@update');
