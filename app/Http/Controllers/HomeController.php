<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Entities\Room\Room;
use App\Entities\Room\Aula;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;
use App\Entities\Reservation;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $url = "Dashboard";

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = Room::with(['roomType', 'roomCondition', 'roomBedType', 
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

        // Box Information
        $checkinToday = Reservation::where('checkin_date', Carbon::today())->count();
        $checkoutToday = Reservation::where('checkout_date', Carbon::today())->count();
        $countReservation = Reservation::count();
        // End Box Information

        $aulas = Aula::listAula();

        return view('contents.home.index', compact(
            'rooms', 
            'countAvailableRooms',
            'roomBedTypes',
            'roomConditions',
            'roomTypes',
            'checkinToday',
            'checkoutToday',
            'countReservation',
            'aulas'
        ));
    }
}
