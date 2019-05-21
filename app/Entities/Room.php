<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Room extends Model
{
    protected $table = "rooms";
    use SoftDeletes;

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
}