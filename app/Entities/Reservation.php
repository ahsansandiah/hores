<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Reservation extends Model
{
    protected $table = "reservations";
    use SoftDeletes;

    const STATUS_CHECKIN = "checkin";
    const STATUS_CHECKOUT = "checkout";
    const STATUS_CANCEL = "cancelled";
    const STATUS_REJECTED = "rejected";

    public function reservationCost()
    {
        return $this->hasOne('App\Entities\ReservationCost', 'reservation_number', 'reservation_number');
    }

    public function roomByRoomNumber()
    {
        return $this->hasOne('App\Entities\Room', 'room_number', 'room_number');
    }

    public function reservationAdditionalCosts()
    {
        return $this->hasMany('App\Entities\ReservationAdditionalCost', 'reservation_id');
    }
}