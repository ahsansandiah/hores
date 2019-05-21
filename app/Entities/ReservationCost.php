<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class ReservationCost extends Model
{
    protected $table = "reservation_cost";

    const status_unpaid = "unpaid";
    const status_paid = "paid";
    const status_down_payment = "down payment";

    public function createReservationCost($reservationCost)
    {
    }
}