<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
        $query = new RoomType();
        if (Input::has('search')) {
            $query->where('name', 'like', '%'.Input::get('search').'%');
        }

        $roomTypes = $query->paginate(20);

        return view('contents.room.type', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $roomType = new RoomType;
        $roomType->name = $request->name;
        $roomType->save();

        if (!$roomType) {
            return Redirect::back()->with('error_message', 'Tambah tipe ruangan gagal');
        }

        return redirect('room/type')->with('message', 'Tambah tipe ruangan berhasil');
    }

    public function update(Request $request)
    {
        $roomType = RoomType::find($request->id);
        $roomType->name = $request->name;
        $roomType->update();

        if (!$roomType) {
            return Redirect::back()->with('error_message', 'Ubah tipe ruangan gagal');
        }

        return redirect('room/type')->with('message', 'Ubah tipe ruangan berhasil');
    }
}
