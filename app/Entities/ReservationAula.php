<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;

class ReservationAula extends Model
{
    protected $table = "aula_reservations";
    protected $guarded = [];
    use SoftDeletes;

    public function aula()
    {
        return $this->belongsTo('App\Entities\Room\Aula', 'aula_id', 'id');
    }

    public static function generateRandom($length = 3)
    {
        $lastId = self::select('id')->first();
        $nextId = $lastId->id + 1;
        $randomNumber = "TRXA-".Carbon::now()->format('ymd').substr(str_shuffle('0123456789'), 1, $length).$nextId;

        return $randomNumber;
    }
}