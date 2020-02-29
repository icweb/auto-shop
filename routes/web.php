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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

    Route::get('customers/search', 'CustomerController@getSearch')->name('customers.search-form');
    Route::post('customers/search', 'CustomerController@postSearch')->name('customers.search');
    Route::resource('customers', 'CustomerController');

    Route::resource('vehicles', 'VehicleController');

});
