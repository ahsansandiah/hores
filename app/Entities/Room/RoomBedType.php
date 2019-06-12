<?php
namespace App\Entities\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class RoomBedType extends Model
{
    protected $table = "room_bed_type";
    use SoftDeletes;

}