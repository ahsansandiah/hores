<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Room\RoomCondition;

class RoomConditionController extends Controller
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
        $roomConditions = RoomCondition::paginate(20);

        return view('contents.room.condition', compact('roomConditions'));
    }

    public function store(Request $request)
    {
        $condition = new RoomCondition;
        $condition->name = $request->name;
        $condition->save();

        return redirect('room/condition');
    }

    public function update(Request $request)
    {
        $condition = RoomCondition::find($request->id);
        $condition->name = $request->name;
        $condition->update();

        return redirect('room/condition');
    }
}
