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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home')->middleware('web');

// Reservation
Route::group(['prefix' => 'reservation', 'middleware' => 'web'], function() {
    Route::get('/', 'Reservation\ReservationController@index')->name('reservation');
    Route::get('/create','Reservation\ReservationController@create');
    Route::post('/store','Reservation\ReservationController@store');
    Route::post('/update','Reservation\ReservationController@update');
    Route::get('/checkout','Reservation\ReservationController@store');
    

});

// Room
Route::group(['prefix' => 'room', 'middleware' => 'web'], function() {
    Route::get('/', 'Room\RoomController@index')->name('room');
    Route::post('/store', 'Room\RoomController@store')->name('room.store');
    Route::get('/delete/{id}', 'Room\RoomController@destroy')->name('room.destroy');

    Route::group(['prefix' => 'condition'], function() {
        Route::get('/', 'Room\RoomConditionController@index')->name('condition');
        Route::post('/store', 'Room\RoomConditionController@store');
        Route::post('/update', 'Room\RoomConditionController@update');

    });
    Route::group(['prefix' => 'type'], function() {
        Route::get('/', 'Room\RoomTypeController@index')->name('type');
        Route::post('/store', 'Room\RoomTypeController@store');
        Route::post('/update', 'Room\RoomtypeController@update');

    });
    Route::group(['prefix' => 'bed_type'], function() {
        Route::get('/', 'Room\RoomBedTypeController@index')->name('bed_type');
        Route::post('/store', 'Room\RoomBedTypeController@store');
        Route::post('/update', 'Room\RoomBedtypeController@update');

    });
});

Route::group(['prefix' => 'service', 'middleware' => 'web'], function() {
    Route::get('/', 'service\ServiceController@index')->name('service');

});
