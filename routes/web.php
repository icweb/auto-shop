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

Route::group(['middleware' => ['firewall.all']], function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['auth']], function(){

        Route::get('customers/search', 'CustomerController@getSearch')->name('customers.search-form');
        Route::post('customers/search', 'CustomerController@postSearch')->name('customers.search');
        Route::get('customers/export', 'CustomerController@export')->name('customers.export');
        Route::resource('customers', 'CustomerController');

        Route::get('vehicles', 'VehicleController@index')->name('vehicles.index');
        Route::get('vehicles/search', 'VehicleController@getSearch')->name('vehicles.search-form');
        Route::get('vehicles/export', 'VehicleController@export')->name('vehicles.export');
        Route::post('vehicles/search', 'VehicleController@postSearch')->name('vehicles.search');
        Route::get('vehicles/{vehicle}', 'VehicleController@show')->name('vehicles.show');
        Route::get('customers/{customer}/vehicles/create', 'VehicleController@create')->name('vehicles.create');
        Route::post('customers/{customer}/vehicles/create', 'VehicleController@store')->name('vehicles.store');
        Route::get('customers/{customer}/vehicles/{vehicle}/edit', 'VehicleController@edit')->name('vehicles.edit');
        Route::put('customers/{customer}/vehicles/{vehicle}/update', 'VehicleController@update')->name('vehicles.update');

        Route::get('customers/{customer}/rendered-services/create', 'RenderedServiceController@create')->name('rendered-services.create');
        Route::post('customers/{customer}/rendered-services', 'RenderedServiceController@store')->name('rendered-services.store');
        Route::get('rendered-services/{rendered_service}', 'RenderedServiceController@show')->name('rendered-services.show');

        Route::resource('appointments', 'AppointmentController');

    });

});


