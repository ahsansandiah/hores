<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Room;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;

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
        $rooms = Room::with('roomType', 'roomCondition')->paginate(30);
        $countAvailableRooms = Room::where('is_booking', 0)->count();
        $roomBedTypes = RoomBedType::all();
        $roomConditions = RoomCondition::all();
        $roomTypes = RoomType::all();

        return view('contents.home.index', compact(
            'rooms', 
            'countAvailableRooms',
            'roomBedTypes',
            'roomConditions',
            'roomTypes'
        ));
    }
}
