<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Entities\Room\Room;
use App\Entities\Tenant;
use Carbon\Carbon;
use Auth;

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
        return $this->hasOne('App\Entities\Room\Room', 'room_number', 'room_number');
    }

    public function reservationAdditionalCosts()
    {
        return $this->hasMany('App\Entities\ReservationAdditionalCost', 'reservation_id');
    }

    public function operator()
    {
        return $this->hasOne('App\user', 'id', 'operator');
    }

    public function createReservation($request, $roomNumber)
    {
        $room = Room::with('roomType', 'roomBedType')
                    ->where('room_number', $roomNumber)
                    ->first();

        // Price
        $priceDay             = $room->price_day;
        $totalAdditionalCost  = 0;
        $removeLastCommaTip   = str_replace(",00", "", $request->service_tip);
        $tipReplace           = preg_replace("/[^0-9]/", "", $removeLastCommaTip);
        $totalPaidRoom        = ($request->total_price + $request->tax + $tipReplace + $totalAdditionalCost) - $request->discount;

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
        $reservation->job                   = $request->job;
        $reservation->adult_guest           = $request->adult;
        $reservation->child_guest           = $request->child;
        $reservation->description           = $request->description;
        $reservation->operator              = Auth::user()->id;
        $reservation->date                  = Carbon::today();

        $reservation->room_number   = $room->room_number;
        $reservation->price_day     = $priceDay;
        $reservation->total_price   = $totalPaidRoom;
        $reservation->status        = "checkin";
        $reservation->save();

        return $reservation;
    }

    public static function generateRandom($length = 3)
    {
        $lastId = self::select('id')->first();
        $nextId = (is_null($lastId) ? 0 : $lastId->id) + 1;
        $randomNumber = "TRX-".Carbon::now()->format('Ymd').substr(str_shuffle('0123456789'), 1, $length).$nextId;

        return $randomNumber;
    }
}