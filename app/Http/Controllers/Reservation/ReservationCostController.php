<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;

use App\User;
use App\Http\Controllers\Controller;
use App\Entities\Reservation;
use App\Entities\ReservationCost;
use App\Entities\Room;

class ReservationCostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $reservationNumber)
    {
        $reservation = Reservation::where('reservation_number', $reservationNumber)->first();
        if ($reservation) {
            $reservation->paid_by = $request->paid_by;
            $reservation->identity_id = $request->identity_id;
            $reservation->institute = $request->institute;
            $reservation->institute_address_first = $request->address_first;
            $reservation->institute_address_second = $request->address_second;
            $reservation->update();

            // Reservation Cost
            $reservationCost = ReservationCost::where('reservation_number', $reservationNumber)->first();
            $reservationCost->payment_date = $request->payment_date;
            $reservationCost->payment_type = $request->payment_type;
            $reservationCost->update();

            return redirect('/reservation/detail/'.$reservationNumber)->with('message', 'Successfully checkout');
        }
    }
    
}
