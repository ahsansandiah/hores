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

class ReservationController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reservations = Reservation::paginate(20);

        return view('contents.reservation.index', compact('reservations'));
    }

    public function create()
    {
        $reservations = Reservation::all();

        return view('contents.reservation.create', compact('reservations'));
    }
    
    public function checkin($roomNumber)
    {
        $room = Room::with('roomType', 'roomBedType')
                    ->where('room_number', $roomNumber)
                    ->first();

        return view('contents.reservation.checkin', compact('room'));
    }

    public function checkinProcess(Request $request, $roomNumber)
    {
        // Validate request
        // $validator = Validator::make($request->all(), 
        //     [
        //         'checkin'       => 'required|date_format:Y-m-d|after:yesterday',
        //     ], $this->validationMessages);

        // if($validator->fails()) {
        //     $validator->messages()->all();
        // }

        $room = Room::with('roomType', 'roomBedType')
                    ->where('room_number', $roomNumber)
                    ->first();

        $priceDay = $room->price_day;
        $totalPriceDuration = $room->price_day * $request->duration;

        // Create Reservation
        $reservation = new Reservation;
        $reservation->reservation_number = $request->reservation_number;
        $reservation->checkin_date = $request->checkin_date;
        $reservation->checkout_date = $request->checkout_date;
        $reservation->duration = $request->duration;
        $reservation->type_identity_card = $request->type_identity_card;
        $reservation->identity_card = $request->identity_number;
        $reservation->name = $request->name;
        $reservation->address = $request->address;
        $reservation->phone_number = $request->phone_number;
        $reservation->adult_guest = $request->adult;
        $reservation->child_guest = $request->child;
        $reservation->description = $request->description;
        $reservation->date = Carbon::today();

        $reservation->room_number = $room->room_number;
        $reservation->price_day = $priceDay;
        $reservation->total_price = $totalPriceDuration;
        $reservation->status = "Down Payment";
        $reservation->save();

        if ($reservation) {
            // Create Reservation Cost
            $reservationCost = new ReservationCost;
            $reservationCost->reservation_number = $request->reservation_number;
            $reservationCost->base_price = $room->price_day;
            $reservationCost->total_price = $totalPriceDuration;
            $reservationCost->service_tip = $request->service_tip;
            $reservationCost->tax = $request->tax;
            $reservationCost->discount = $request->discount;
            $reservationCost->deposit = $request->deposit;
            $reservationCost->status = $reservationCost::status_unpaid;
            $reservationCost->save();
    
            // Update Status Room
            $room->is_booking = 1;
            $room->update();

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Successfully checkin');
        }
        
        return redirect('/reservation')->with('error_message', 'Failed checkin');
    }

    public function show($reservationNumber)
    {
        $reservation = Reservation::with('reservationCost')
                    ->where('reservation_number', $reservationNumber)
                    ->first();
                    
        $room = Room::with('roomType', 'roomBedType')
                ->where('room_number', $reservation->room_number)
                ->first();

        return view('contents.reservation.detail', compact('reservation', 'room'));
    }
}
