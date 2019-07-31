<?php

namespace App\Entities\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Room extends Model
{
    protected $table = "rooms";
    use SoftDeletes;

    const STATUS_AVAILABLE = "Good";
    const STATUS_RENOVATION = "Renovation";

    public function roomType()
    {
        return $this->hasOne('App\Entities\Room\RoomType', 'id', 'type');
    }

    public function roomBedType()
    {
        return $this->hasOne('App\Entities\Room\RoomBedType', 'id', 'bed_type');
    }

    public function roomCondition()
    {
        return $this->hasOne('App\Entities\Room\RoomCondition', 'id', 'condition');
    }

    public function reservations()
    {
        return $this->belongsTo('App\Entities\Reservation', 'room_number', 'room_number');
    }

    public static function updateStatusCanBooking($roomNumber, $can)
    {
        $model = self::where('room_number', $roomNumber)->first();
        if ($can == true) {
            $model->is_booking = 0;
            $model->save();
        } else {
            $model->is_booking = 1;
            $model->save();
        }

        return true;
    }
}