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
use Cache;
use Session;
use PDF;

use App\User;
use App\Entities\Reservation;
use App\Entities\ReservationCost;
use App\Entities\ReservationAdditionalCost;
use App\Entities\Room;
use App\Entities\Service;
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
        
        $reservations = $query->paginate(10);

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
                    ->where('is_booking', '0')
                    ->first();

        if (!$room) {
            return redirect('/reservation/select-room');
        }
        
        $additionalServices = Service::all();

        $additionalServiceCache = null;
        if( Session::has('additional-services-'.$roomNumber) ) {
            $additionalServiceCache = Session::get('additional-services-'.$roomNumber);
        }

        $reservationNumber = Reservation::generateRandom();

        // Session::forget('additional-services-'.$roomNumber);
        return view('contents.reservation.checkin', compact('room', 'additionalServices', 'additionalServiceCache', 'reservationNumber'));
    }

    public function addAdditonalService($roomNumber)
    {
        $additionalServiceCache = null;
        if( Session::has('additional-services-'.$roomNumber) ) {
            if (Input::all()) {
                $additionalServiceCache = Session::push('additional-services-'.$roomNumber, Input::all(), 60*24);
            }
            
            $additionalServiceCache = Session::get('additional-services-'.$roomNumber);
        } else {
            if (Input::all()) {
                $additionalServiceCache = Session::push('additional-services-'.$roomNumber, Input::all(), 60*24);
            }
        }

        return view('contents.reservation.additional-service', compact('additionalServiceCache'));
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

        // Price
        $priceDay             = $room->price_day;
        $totalAdditionalCost  = 0;
        $totalPaidRoom        = ($request->total_price + $request->tax + $request->service_tip + $totalAdditionalCost) - $request->discount;

        // Create Reservation
        $createReservation = new Reservation;
        $reservation = $createReservation->createReservation($request, $roomNumber);

        if ($reservation) {
            // Additional Cost
            if( Session::has('additional-services-'.$roomNumber) ) {
                $additionalServiceCaches = Session::get('additional-services-'.$roomNumber);
                $total = null;
                foreach ($additionalServiceCaches as $value) {
                    $additionalCost = new ReservationAdditionalCost();
                    $additionalCost->createReservationAdditionalCost($value, $reservation->id);

                    $totalDiskon = ($request['price'] * $request['quantity']);
                    if ($value['discount'] != 0 || !empty($value['discount'])) {
                        $totalDiskon = ($value['discount'] / 100) * ($value['price'] * $value['quantity']);
                    }

                    $total += $totalDiskon; 
                }

                $totalAdditionalCost = $total;
            }

            $totalPaid = $totalPaidRoom + $totalAdditionalCost;
            $underPayment  = $totalPaid - $request->deposit;

            // Create Reservation Cost
            $reservationCost = new ReservationCost;
            $reservationCost->reservation_number    = $request->reservation_number;
            $reservationCost->base_price            = $room->price_day;
            $reservationCost->total_price           = $totalPaid;
            $reservationCost->underpayment          = $underPayment;
            $reservationCost->total_additional_cost = $totalAdditionalCost;
            $reservationCost->service_tip           = $request->service_tip;

            $reservationCost->tax_percent           = $request->tax_percent;
            $reservationCost->tax                   = $request->tax;

            $reservationCost->discount_percent      = $request->discount_percent;
            $reservationCost->discount              = $request->discount;

            $reservationCost->deposit               = $request->deposit;
            $reservationCost->status                = $reservationCost::status_unpaid;
            if ($request->deposit) $reservationCost->status = $reservationCost::status_down_payment;

            $reservationCost->save();
    
            // Update Status Room
            $room->is_booking = 1;
            $room->update();

            // Nota Checkin

            Session::forget('additional-services-'.$roomNumber);
            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Checkin berhasil');
        }
        
        return redirect('/reservation')->with('error_message', 'Checkin gagal');
    }

    public function show($reservationNumber)
    {
        $reservation = Reservation::with('reservationCost', 'reservationAdditionalCosts')
                    ->where('reservation_number', $reservationNumber)
                    ->first();

        if (empty($reservation)) {
            return redirect('/reservation');
        } 

        $room = Room::with('roomType', 'roomBedType')
                ->where('room_number', $reservation->room_number)
                ->first();

        // Additional Cost
        $reservationAdditionalCosts = ReservationAdditionalCost::where('reservation_id', $reservation->id)->get();

        return view('contents.reservation.detail', compact('reservation', 'room', 'reservationAdditionalCosts'));
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
        $reservation =  Reservation::with('reservationCost')->findOrFail($id);

        $priceDay             = $reservation->price_day;
        $totalAdditionalCost  = 0;
        $totalPaidRoom        = ($request->total_price + $request->tax + $request->service_tip + $totalAdditionalCost) - $request->discount;

        $reservation->checkin_date       = $request->checkin_date;
        $reservation->checkout_date      = $request->checkout_date;
        $reservation->duration           = $request->duration;
        $reservation->type_identity_card = $request->type_identity_card;
        $reservation->identity_card      = $request->identity_number;
        $reservation->name               = $request->name;
        $reservation->city               = $request->city;
        $reservation->address            = $request->address;
        $reservation->phone_number       = $request->phone_number;
        $reservation->adult_guest        = $request->adult;
        $reservation->child_guest        = $request->child;
        $reservation->description        = $request->description;
        $reservation->update();

        if ($reservation) {
            $totalPaid = $totalPaidRoom + $totalAdditionalCost;
            $underPayment  = $totalPaid - $request->deposit;

            // Create Reservation Cost
            $reservationCost = ReservationCost::findOrFail($reservation->reservationCost->id);
            $reservationCost->base_price            = $reservation->price_day;
            $reservationCost->total_price           = $totalPaid;
            $reservationCost->underpayment          = $underPayment;
            $reservationCost->service_tip           = $request->service_tip;
            $reservationCost->tax_percent           = $request->tax_percent;
            $reservationCost->tax                   = $request->tax;
            $reservationCost->discount_percent      = $request->discount_percent;
            $reservationCost->discount              = $request->discount;
            $reservationCost->deposit               = $request->deposit;

            $reservationCost->update();

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Ubah data checkin berhasil');
        }
        
        return redirect('/reservation')->with('error_message', 'Ubah data checkin gagal');
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
            $reservation->checkout_date          = $request->input('checkout_date');
            $reservation->payments_identity_id   = $request->input('identity_number');
            $reservation->payments_on_behalf     = $request->input('name');
            $reservation->payments_address_first = $request->input('address');
            $reservation->payments_phone_number  = $request->input('phone_number');
            $reservation->paid_by                = $request->input('paid_by');
            $reservation->status                 = "checkout";
            $reservation->update();

            $reservationCost = ReservationCost::where('reservation_number', $reservationNumber)->first();
            if ($reservationCost) {
                $reservationCost->status        = $reservationCost::status_paid;
                $reservationCost->payment_date  = $request->input('payment_date');
                $reservationCost->payment_type  = $request->input('payment_type');
                $reservationCost->underpayment  = 0;
                $reservationCost->update();
            }

            $room = Room::where('room_number', $request->input('room_number'))->first();
            if ($room) {
                $room->is_booking = 0;
                $room->update();
            }

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Checkout berhasil');
        }

        return redirect('/reservation/detail/'.$reservation->reservation_number)->with('error_message', 'Checkout gagal');
    }

    public function exchangeRoom(Request $request, $reservationNumber)
    {
        $reservation = Reservation::with('reservationCost')->where('reservation_number', $reservationNumber)->first();
        $lastReservationRoomNumber = $reservation->room_number;
        $rooms = Room::whereNotIn('room_number', [$lastReservationRoomNumber])
                        ->whereNotIn('is_booking', [1])
                        ->whereNotIn('condition', [2])
                        ->get();

        if ($request->all()) {
            $query = new ReservationCost();
            $discount = $query->formula($request->price, $request->discount);
            $tax      = $query->formula($request->price, $request->tax);
            $total    = $query->formulaTotalPaid(
                            ($request->price * $reservation->duration), 
                            $discount, 
                            $tax, 
                            $reservation->reservationCost->service_tip, 
                            $reservation->reservationCost->total_additional_cost
                        );
            $totalWithDeposit = $total - $request->deposit;

            // Update Reservation
            $reservation->room_number   = $request->room;
            $reservation->price_day     = $request->price;
            $reservation->total_price   = $total;
            $reservation->update();

            // Update Reservation Cost
            $reservationCost = $query->findOrFail($reservation->reservationCost->id);
            $reservationCost->base_price  = $request->price;
            $reservationCost->total_price = $total;
            $reservationCost->tax         = $tax;
            $reservationCost->tax_percent = $request->tax;
            $reservationCost->discount    = $discount;
            $reservationCost->discount_percent = $request->discount;
            $reservationCost->deposit      = $request->deposit;
            $reservationCost->underpayment = $totalWithDeposit;
            // $reservationCost->update();

            // Update Status Room
            $newRoom = Room::updateStatusCanBooking($request->room, false);
            $lastRoom = Room::updateStatusCanBooking($lastReservationRoomNumber, true);

            return redirect('/reservation/detail/'.$reservation->reservation_number)->with('message', 'Pindah kamar berhasil');            
        }

        return view('contents.reservation.exchange-room', compact('reservation', 'rooms'));
    }

    public function print($reservationNumber)
    {
        $reservation = Reservation::with('reservationCost', 'reservationAdditionalCosts')
                    ->where('reservation_number', $reservationNumber)
                    ->first();

        if (empty($reservation)) {
            return redirect('/reservation');
        } 

        $room = Room::with('roomType', 'roomBedType')
                ->where('room_number', $reservation->room_number)
                ->first();

        // Additional Cost
        $reservationAdditionalCosts = ReservationAdditionalCost::where('reservation_id', $reservation->id)->get();

        // return view('contents.reservation.invoice', compact('reservation', 'room', 'reservationAdditionalCosts'));
        $pdf = PDF::loadView('contents.reservation.invoice-2', compact('reservation', 'room', 'reservationAdditionalCosts'));
        // $pdf = PDF::loadView('contents.reservation.invoice', compact('reservation', 'room', 'reservationAdditionalCosts'));
        $pdf->setPaper('A4', 'landscape');
        $filename = "invoice-".$reservation->reservation_number;
        return $pdf->download($filename.".pdf");
    }
}
