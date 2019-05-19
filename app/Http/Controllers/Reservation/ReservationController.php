<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Reservation;

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
    public function store()
    {

        $reservations = Reservation::all();

        return view('contents.reservation.checkout', compact('reservations'));

        // $reservations = new Reservation;
        // $reservations->reservation_number = $request->request_number;
        // $reservations->identity_card = $request ->identity_card;
        // $reservations->room_number = $request ->room_number;
        // $reservations->name = $request ->contact_name;
        // $reservations->phone_number = $request->phone_number;
        // $reservations->checkin_date = $request->check_in;
        // $reservations->checkout_date = $request->check_out;

        // return redirect('reservation/s');
    }
    public function create()
    {
        $reservations = Reservation::all();

        return view('contents.reservation.create', compact('reservations'));
    }
    
}
