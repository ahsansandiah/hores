<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Entities\Room;
use Carbon\Carbon;

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

    public function createReservation($request, $roomNumber)
    {
        $room = Room::with('roomType', 'roomBedType')
                    ->where('room_number', $roomNumber)
                    ->first();

        // Price
        $priceDay             = $room->price_day;
        $totalAdditionalCost  = 0;
        $totalPaidRoom        = ($request->total_price + $request->tax + $request->service_tip + $totalAdditionalCost) - $request->discount;

        // Create Reservation
        $reservation = new Reservation;
        $reservation->reservation_number    = $request['reservation_number'];
        $reservation->checkin_date          = $request->checkin_date;
        $reservation->checkout_date         = $request->checkout_date;
        $reservation->duration              = $request->duration;
        $reservation->type_identity_card    = $request->type_identity_card;
        $reservation->identity_card         = $request->identity_number;
        $reservation->name                  = $request->name;
        $reservation->address               = $request->address;
        $reservation->phone_number          = $request->phone_number;
        $reservation->adult_guest           = $request->adult;
        $reservation->child_guest           = $request->child;
        $reservation->description           = $request->description;
        $reservation->date                  = Carbon::today();

        $reservation->room_number   = $room->room_number;
        $reservation->price_day     = $priceDay;
        $reservation->total_price   = $totalPaidRoom;
        $reservation->status        = "checkin";
        $reservation->save();

        return $reservation;
    }
}