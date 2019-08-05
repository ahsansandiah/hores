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
    Route::get('/detail/{reservationNumber}', 'Reservation\ReservationController@show');
    Route::get('/exchange-room/{reservationNumber}', 'Reservation\ReservationController@exchangeRoom');
    Route::post('/exchange-room/{reservationNumber}/process', 'Reservation\ReservationController@exchangeRoom');
    Route::get('/detail/{reservationNumber}/print', 'Reservation\ReservationController@print');

    Route::get('/select-room', 'Reservation\ReservationController@selectRoom');
    
    Route::get('/check-in/{roomId}','Reservation\ReservationController@checkin');
    Route::post('/check-in/{roomId}/store','Reservation\ReservationController@checkinProcess');
    Route::get('/check-out/{reservationNumber}','Reservation\ReservationController@checkout');
    Route::post('/check-out/{reservationNumber}/process','Reservation\ReservationController@checkoutProcess');

    Route::post('/add-additional-services/{roomId}', 'Reservation\ReservationController@addAdditonalService');
    Route::get('/other-service/{reservationNumber}','Reservation\ReservationController@otherService');
    Route::post('/store/additional-services/{reservationId}', 'Reservation\ReservationController@storeAdditonalService');
    Route::post('/update/additional-services/{additionalServiceId}', 'Reservation\ReservationController@updateAdditonalService');
    Route::get('/delete/additional-services/{additionalServiceId}', 'Reservation\ReservationController@deleteAdditonalService');

    Route::get('/create','Reservation\ReservationController@create');
    Route::post('/store','Reservation\ReservationController@store');
    Route::get('/edit/{id}','Reservation\ReservationController@edit');
    Route::post('/update/{id}','Reservation\ReservationController@update');
    Route::get('/delete/{id}','Reservation\ReservationController@destroy');
});

// Room
Route::group(['prefix' => 'room', 'middleware' => 'web'], function() {
    Route::get('/', 'Room\RoomController@index')->name('room');
    Route::post('/store', 'Room\RoomController@store')->name('room.store');
    Route::get('/delete/{id}', 'Room\RoomController@destroy')->name('room.destroy');
    Route::get('/edit/{id}', 'Room\RoomController@edit')->name('room.edit');
    Route::post('/update/{id}', 'Room\RoomController@update')->name('room.update');

    Route::group(['prefix' => 'condition'], function() {
        Route::get('/', 'Room\RoomConditionController@index')->name('condition');
        Route::post('/store', 'Room\RoomConditionController@store');
        Route::post('/update', 'Room\RoomConditionController@update');

    });
    Route::group(['prefix' => 'type'], function() {
        Route::get('/', 'Room\RoomTypeController@index')->name('type');
        Route::post('/store', 'Room\RoomTypeController@store');
        Route::post('/update', 'Room\RoomTypeController@update');

    });
    Route::group(['prefix' => 'bed-type'], function() {
        Route::get('/', 'Room\RoomBedTypeController@index')->name('bed_type');
        Route::post('/store', 'Room\RoomBedTypeController@store');
        Route::post('/update', 'Room\RoomBedTypeController@update');

    });
});

Route::group(['prefix' => 'aula', 'middleware' => 'web'], function() {
    Route::get('/', 'Room\AulaController@index')->name('aula');
    Route::get('/create', 'Room\AulaController@create')->name('aula.create');
    Route::post('/store', 'Room\AulaController@store')->name('aula.store');
    Route::get('/detail/{id}', 'Room\AulaController@show')->name('aula.detail');
    Route::get('/edit/{id}', 'Room\AulaController@edit')->name('aula.edit');
    Route::post('/update/{id}', 'Room\AulaController@update')->name('aula.update');
    Route::get('/delete/{id}', 'Room\AulaController@destroy')->name('aula.destroy');

    Route::get('/reservation', 'Room\AulaController@listReservation')->name('aula.list.reservation');
    Route::get('/reservation/{id}', 'Room\AulaController@reservation')->name('aula.reservation');
    Route::get('/reservation/detail/{id}', 'Room\AulaController@detailReservation')->name('aula.reservation.detail');
    Route::post('/reservation/{id}/store', 'Room\AulaController@reservationProcess')->name('aula.reservation.process');
    Route::get('/reservation/edit/{id}', 'Room\AulaController@reservation')->name('aula.reservation.edit');
    Route::get('/reservation/{id}', 'Room\AulaController@reservation')->name('aula.reservation.detail');
    Route::post('/reservation/payment/{reservationId}', 'Room\AulaController@payment')->name('aula.reservation.payment');
    Route::get('/reservation/{id}/print', 'Room\AulaController@print')->name('aula.reservation.print');
});

Route::group(['prefix' => 'service', 'middleware' => 'web'], function() {
    Route::get('/', 'Service\ServiceController@index')->name('service');
    Route::post('/store', 'Service\ServiceController@store')->name('service.store');
    Route::post('/update/{id}', 'Service\ServiceController@update')->name('service.update');
    Route::get('/destroy/{id}', 'Service\ServiceController@destroy')->name('service.destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function() {
    // users route
    Route::get('users', 'UserManagement\UserController@index');
    Route::post('user', 'UserManagement\UserController@store');
    Route::post('user/update/{id}', 'UserManagement\UserController@update');
    Route::get('user/delete/{id}', 'UserManagement\UserController@destroy');

    // roles route
    Route::get('roles', 'UserManagement\RoleController@index');
    Route::post('role', 'UserManagement\RoleController@store');
    Route::post('role/update/{id}', 'UserManagement\RoleController@update');
    Route::get('role/delete/{id}', 'UserManagement\RoleController@destroy');
    Route::post('role/set-menu', 'UserManagement\RoleController@setRoleMenu');

    // actions route
    Route::get('actions', 'UserManagement\ActionController@index');
    Route::post('action', 'UserManagement\ActionController@store');
    Route::post('action/update/{id}', 'UserManagement\ActionController@update');
    Route::get('action/delete/{id}', 'UserManagement\ActionController@destroy');

    // menus route
    Route::get('menus', 'UserManagement\MenuController@index');
    Route::post('menu', 'UserManagement\MenuController@store');
    Route::post('menu/update/{id}', 'UserManagement\MenuController@update');
    Route::get('menu/delete/{id}', 'UserManagement\MenuController@destroy');
    Route::get('menu/get-role-menu/{id}', 'UserManagement\MenuController@getRoleMenu');
});

Route::group(['prefix' => 'report', 'middleware' => 'web'], function() {
    Route::get('/transaction', 'ReportController@transaction')->name('transaction');
    Route::get('/income', 'ReportController@income')->name('income');
    Route::get('/income/print/{type}', 'ReportController@incomeReport')->name('income.report');
});

Route::group(['prefix' => 'backup-db', 'middleware' => 'web'], function() {
    Route::get('/', 'BackupDBController@index')->name('backup-db.index');
    Route::get('/process', 'BackupDBController@backup')->name('backup-db.backup');
});

