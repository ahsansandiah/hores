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
        $roombedType = new RoomBedType;
        $roombedType->name = $request->name;
        $roombedType->save();

        if (!$roombedType) {
            return Redirect::back()->with('error_message', 'Tambah tipe ranjang gagal');
        }

        return redirect('room/bed-type')->with('message', 'Tambah tipe ranjang berhasil');

    }

    public function update(Request $request)
    {
        $roombedType = RoomBedType::find($request->id);
        $roombedType->name = $request->name;
        $roombedType->update();

        if (!$roombedType) {
            return Redirect::back()->with('error_message', 'Ubah tipe ranjang gagal');
        }

        return redirect('room/bed-type')->with('message', 'Ubah tipe ranjang berhasil');
    }
}
