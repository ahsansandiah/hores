<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Room\RoomType;

class RoomTypeController extends Controller
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
        $roomTypes = RoomType::paginate(20);

        return view('contents.room.type', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $condition = new RoomType;
        $condition->name = $request->name;
        $condition->save();

        return redirect('room/type');
    }

    public function update(Request $request)
    {
        $condition = RoomType::find($request->id);
        $condition->name = $request->name;
        $condition->update();

        return redirect('room/type');
    }
}
