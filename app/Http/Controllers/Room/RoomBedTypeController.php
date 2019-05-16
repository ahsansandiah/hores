<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Room\RoomBedType;

class RoomBedTypeController extends Controller
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
        $roombedTypes = RoomBedType::paginate(20);

        return view('contents.room.bedtype', compact('roombedTypes'));
    }

    public function store(Request $request)
    {
        $condition = new RoomBedType;
        $condition->name = $request->name;
        $condition->save();

        return redirect('room/bed_type');
    }

    public function update(Request $request)
    {
        $condition = RoomBedType::find($request->id);
        $condition->name = $request->name;
        $condition->update();

        return redirect('room/bed_type');
    }
}
