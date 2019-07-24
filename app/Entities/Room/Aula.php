<?php

namespace App\Entities\Room;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Aula extends Model
{
    protected $table = "aula";
    use SoftDeletes;

    public function reservationAula()
    {
        return $this->hasOne('App\Entities\ReservationAula', 'aula_id', 'id');
    }

    public static function listAula()
    {
        $query = self::with('reservationAula');
        $countAvailable = $query->where('is_booking', 0)->count();
        $aulas = $query->paginate(16);

        return [
            "aulas" => $aulas,
            "countAvailable" => $countAvailable
        ];
    }
}