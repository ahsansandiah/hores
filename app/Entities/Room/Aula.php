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
        return $this->belongsTo('App\Entities\ReservationAula', 'aula_id', 'id');
    }
}