<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;

use App\User;
use App\Entities\Reservation;
use App\Entities\ReservationCost;
use App\Entities\Room;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;

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
        $query = Reservation::with('reservationCost');

        if (Input::has('search')) {
            $query->where('room_number', 'like', '%'.Input::get('search').'%')
                ->orWhere('reservation_number', 'like', '%'.Input::get('search').'%')
                ->orWhere('name', 'like', '%'.Input::get('search').'%');
        }
        
        $reservations = $query->paginate(20);

        return view('contents.reservation.index', compact('reservations'));
    }

    public function create()
    {
        $reservations = Reservation::all();

        return view('contents.reservation.create', compact('reservations'));
    }

    public function selectRoom()
    {
        $query = Room::with(['roomType', 'roomCondition', 
                    'reservations' => function ($query) {
                        $query->where('status', Reservation::STATUS_CHECKIN);
                    }
                ]);
        
        if (Input::has('search')) {
            $query->where('room_number', Input::get('search'))
                ->orWhere('price_day', Input::get('search'))
                ->orWhere('guest_total', Input::get('search'));
        }

        if (Input::has('is_booking')) {
            $query->where('is_booking', Input::get('is_booking'));
        }

        $rooms = $query->paginate(30);

        $countAvailableRooms = Room::where('is_booking', 0)->count();
        $roomBedTypes = RoomBedType::all();
        $roomConditions = RoomCondition::all();
        $roomTypes = RoomType::all();

        return view('contents.reservation.select-room', compact(
            'rooms', 
            'countAvailableRooms',
            'roomBedTypes',
            'roomConditions',
            'roomTypes'
        ));
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

        // Price
        $totalPriceDuration = ($request->total_price + $request->tax + $request->service_tip) - $request->discount;
        $totalPaid = $totalPriceDuration - $request->deposit;

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
        $reservation->total_price = $totalPaid;
        $reservation->status = "checkin";
        $reservation->save();

        if ($reservation) {
            // Create Reservation Cost
            $reservationCost = new ReservationCost;
            $reservationCost->reservation_number = $request->reservation_number;
            $reservationCost->base_price = $room->price_day;
            $reservationCost->service_tip = $request->service_tip;

            $reservationCost->tax_percent = $request->tax_percent;
            $reservationCost->tax = $request->tax;

            $reservationCost->discount_percent = $request->discount_percent;
            $reservationCost->discount = $request->discount;

            $reservationCost->deposit = $request->deposit;
            $reservationCost->status = $reservationCost::status_unpaid;
            if ($request->deposit) $reservationCost->status = $reservationCost::status_down_payment;

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

        if (empty($reservation)) {
            return redirect('/reservation');
        } 

        $room = Room::with('roomType', 'roomBedType')
                ->where('room_number', $reservation->room_number)
                ->first();

        $statusPayment = $reservation->reservationCost->status;
        if ($statusPayment == "paid") {
            $statusPayment = "Lunas";
        } else {
            $statusPayment = "Belum Lunas";
        }

        return view('contents.reservation.detail', compact('reservation', 'room', 'statusPayment'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with('reservationCost')->findOrFail($id);
        $room = Room::with('roomType', 'roomBedType')
                    ->where('room_number', $reservation->room_number)
                    ->first();
        
        return view('contents.reservation.edit', compact('room', 'reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation =  Reservation::findOrFail($id);
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
        $reservation->update();

        if ($reservation) {
            // Create Reservation Cost
            $reservationCost = ReservationCost::findOrFail($request->reservation_cost_id);
            $reservationCost->base_price = $room->price_day;
            $reservationCost->total_price = $totalPriceDuration;
            $reservationCost->service_tip = $request->service_tip;
            $reservationCost->tax = $request->tax;
            $reservationCost->discount = $request->discount;
            $reservationCost->deposit = $request->deposit;
            $reservationCost->update();

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Successfully checkin');
        }
        
        return redirect('/reservation')->with('error_message', 'Failed checkin');
    }

    public function checkout($reservationNumber)
    {
        $reservation = Reservation::with('reservationCost')
            ->where('reservation_number', $reservationNumber)
            ->first();

        return view('contents.reservation.checkout', compact('reservation'));
    }

    public function checkoutProcess(Request $request, $reservationNumber)
    {
        $reservation = Reservation::with('reservationCost')
            ->where('reservation_number', $reservationNumber)
            ->first();

        if ($reservation) {
            $reservation->checkout_date = $request->input('checkout_date');
            $reservation->payments_identity_id = $request->input('identity_number');
            $reservation->payments_on_behalf = $request->input('name');
            $reservation->payments_address_first = $request->input('address');
            $reservation->payments_phone_number = $request->input('phone_number');
            $reservation->paid_by = $request->input('paid_by');
            $reservation->status = "checkout";
            $reservation->update();

            $reservationCost = ReservationCost::where('reservation_number', $reservationNumber)->first();
            if ($reservationCost) {
                $totalPrice = $reservation->total_price + $reservationCost->deposit;
                $reservationCost->status = $reservationCost::status_paid;
                $reservationCost->payment_type = $request->input('payment_type');
                $reservationCost->total_price = $totalPrice;
                $reservationCost->payment_date = $request->input('payment_date');
                $reservationCost->update();
            }

            $room = Room::where('room_number', $request->input('room_number'))->first();
            if ($room) {
                $room->is_booking = 0;
                $room->update();
            }

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Successfully checkout');
        }

        return redirect('/reservation/detail/'.$reservation->reservation_number)->with('error_message', 'Failed checkout');
    }
}
