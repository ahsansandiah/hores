<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Room;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;

class RoomController extends Controller
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

    public function index()
    {
        $rooms = Room::paginate(20);
        $roomBedTypes = RoomBedType::all();
        $roomConditions = RoomCondition::all();
        $roomTypes = RoomType::all();

        return view('contents.room.index', compact('rooms', 'roomBedTypes', 'roomConditions', 'roomTypes'));
    }

    public function store(Request $request)
    {
        $room = new Room;
        $room->room_number   = $request->room_number;
        $room->type          = $request->type;
        $room->price_day     = $request->price;
        $room->bed_type      = $request->bed_type;
        $room->guest_total   = $request->guest_max;
        $room->fee_breakfast = $request->fee_breakfast;
        $room->condition     = $request->condition;
        $room->is_booking    = true;
        $room->is_active     = true;
        $room->save();

        return redirect('room');
    }
}
