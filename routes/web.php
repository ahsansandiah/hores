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
});

// Room
Route::group(['prefix' => 'room', 'middleware' => 'web'], function() {
    Route::get('/', 'Room\RoomController@index')->name('room');

    Route::group(['prefix' => 'condition'], function() {
        Route::get('/', 'Room\RoomConditionController@index')->name('condition');
        Route::post('/store', 'Room\RoomConditionController@store');
        Route::post('/update', 'Room\RoomConditionController@update');

    });
});
