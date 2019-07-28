<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

use App\Http\Controllers\Controller;
use App\Entities\Room;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;

class RoomController extends Controller
{

    protected $validationMessages = [
        'room_number.required'  => 'Nomor Ruangan harus diisi',
        'room_number.unique'    => 'Nomor Ruangan tidak boleh sama',
    ];

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
        $query = Room::with(['roomType', 'roomCondition', 
                            'reservations' => function ($query) {
                                $query->where('status', 'checkin')->first();
                            }
                        ]);
        
        if (Input::has('search')) {
            $query->where('room_number', 'like', '%'.Input::get('search').'%')
                ->orWhere('price_day', 'like', '%'.Input::get('search').'%')
                ->orWhere('guest_total', 'like', '%'.Input::get('search').'%');
        }
        
        $rooms = $query->paginate(10);
        $roomBedTypes = RoomBedType::all();
        $roomConditions = RoomCondition::all();
        $roomTypes = RoomType::all();

        return view('contents.room.index', compact('rooms', 'roomBedTypes', 'roomConditions', 'roomTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
                        [
                            'room_number' => 'required|unique:rooms,room_number',
                        ], $this->validationMessages );

        if ($validator->fails()) {
            return Redirect::back()->with('error_message', $validator->errors());
        }

        $room = new Room;
        $room->room_number   = $request->room_number;
        $room->type          = $request->type;
        $room->price_day     = $request->price;
        $room->bed_type      = $request->bed_type;
        $room->guest_total   = $request->guest_max;
        $room->fee_breakfast = $request->fee_breakfast;
        $room->condition     = $request->condition;
        $room->description   = $request->description;
        $room->is_booking    = false;
        $room->is_active     = true;
        $room->save();

        if (!$room) {
            return Redirect::back()->with('error_message', 'Tambah Ruangan gagal');
        }

        return redirect('room')->with('message', 'Tambah ruangan berhasil');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $roomBedTypes = RoomBedType::all();
        $roomConditions = RoomCondition::all();
        $roomTypes = RoomType::all();

        return view('contents.room.edit', compact('room', 'roomBedTypes', 'roomConditions', 'roomTypes'));
    }

    public function update(Request $request, $id)
    {
        $checkRoomNumber = Room::where('room_number', $request->room_number)
                                    ->whereNotIn('id', [$id])
                                    ->get();

        if ($checkRoomNumber->count() > 0) {
            return Redirect::back()->with('error_message', 'Maaf nomor ruangan sudah tersedia');
        }

        $room = Room::find($id);
        $room->room_number   = $request->room_number;
        $room->type          = $request->type;
        $room->price_day     = $request->price;
        $room->bed_type      = $request->bed_type;
        $room->guest_total   = $request->guest_max;
        $room->fee_breakfast = $request->fee_breakfast;
        $room->condition     = $request->condition;
        $room->is_active     = $request->is_active;;
        $room->save();

        if (!$room) {
            return Redirect::back()->with('error_message', 'Ubah ruangan gagal');
        }

        return redirect('room')->with('message', 'Ubah ruangan berhasil');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        if ($room->is_booking == 1) {
            return Redirect::back()->with('error_message', 'Hapus gagal, silahkan check status reservasi ruangan');
        }

        $room->delete();

        return Redirect::back()->with('message', 'Hapus ruangan berhasil');
    }
}
