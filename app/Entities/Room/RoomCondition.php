<?php

namespace App\Entities\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class RoomCondition extends Model
{
    protected $table = "room_condition";
}