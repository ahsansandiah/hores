<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class ReservationAdditionalCost extends Model
{
    protected $table = "reservation_additional_cost";
    use SoftDeletes;

}