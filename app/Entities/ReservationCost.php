<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Carbon\Carbon;

class ReservationCost extends Model
{
    protected $table = "reservation_cost";
    use SoftDeletes;

    const status_unpaid = "unpaid";
    const status_paid = "paid";
    const status_down_payment = "down payment";

    public static function totalIncome()
    {
        return self::sum('total_price');
    }

    public static function totalIncomeMonthly()
    {
        return self::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
    }

    public static function firstData()
    {
        return self::orderBy('created_at', 'asc')->first();
    }

    public static function latestData()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

    public static function formula($price, $percent)
    {
        return ($percent / 100) * $price;
    }

    public static function formulaTotalPaid($price, $discount, $tax, $service, $additionalCost)
    {
        return ($price + $service + $additionalCost + $tax) - $discount;
    }
}