<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\User;

class ReservationAdditionalCost extends Model
{
    protected $table = "reservation_additional_cost";
    use SoftDeletes;

    public function createReservationAdditionalCost($request, $reservationId)
    {
        $additionalCost = new ReservationAdditionalCost();
        $additionalCost->reservation_id = $reservationId;
        $additionalCost->name = $request['service'];
        $additionalCost->quantity = $request['quantity'];
        $additionalCost->base_price = $request['price'];
        $additionalCost->discount_percent = $request['discount'];
        $additionalCost->description = $request['description'];
        $totalDiskon = ($request['price'] * $request['quantity']);
        if ($request['discount'] != 0 || !empty($value['discount'])) {
            $totalDiskon = ($request['discount'] / 100) * ($request['price'] * $request['quantity']);
        }
        
        $additionalCost->price = $totalDiskon;
        $additionalCost->save();

        return $additionalCost;
    }
}