<?php

namespace App\Http\Controllers\Room;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;
use PDF;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Entities\Room\Room;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;
use App\Entities\Room\Aula;
use App\Entities\ReservationAula;

class AulaController extends Controller
{
    protected $validationMessages = [
        'number.required'  => 'Nomor Aula harus diisi',
        'number.unique'    => 'Nomor Aula tidak boleh sama',
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
        $aulas = Aula::with('reservationAula')->paginate(10);

        return view('contents.aula.index', compact('aulas'));
    }

    public function create()
    {
        return view('contents.aula.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
                        [
                            'number' => 'required|unique:aula,number',
                        ], $this->validationMessages );

        if ($validator->fails()) {
            return Redirect::back()->with('error_message', $validator->errors());
        }

        $aula = new Aula;
        $aula->number         = $request->number;
        $aula->category       = $request->category;
        $aula->price_day      = $request->price_day;
        $aula->guest_total    = $request->guest_total;
        $aula->description    = $request->description;
        $aula->aula_condition = $request->condition;
        $aula->is_active      = $request->is_active;
        $aula->is_booking     = false;
        $aula->save();

        if (!$aula) {
            return Redirect::back()->with('error_message', 'Tambah Aula gagal');
        }

        return redirect('aula')->with('message', 'Tambah Aula berhasil');
    }

    public function show($id)
    {
        $aula = Aula::with(['reservationAula' => function ($query) {
                        $query->where('status', 'booked')->first();
                    }])->findOrFail($id);

        return view('contents.aula.detail', compact('aula'));
    }

    public function edit($id)
    {
        $aula = Aula::findOrFail($id);

        return view('contents.aula.edit', compact('aula'));
    }

    public function update(Request $request, $id)
    {
        $validNumber = Aula::where('number', $request->number)->whereNotIn('id', [$id])->get();
        if ($validNumber->count() > 0) {
            return Redirect::back()->with('error_message', 'Nomor Aula sudah tersedia');
        }

        $aula = Aula::findOrFail($id);
        $aula->number         = $request->number;
        $aula->category       = $request->category;
        $aula->price_day      = $request->price_day;
        $aula->guest_total    = $request->guest_total;
        $aula->description    = $request->description;
        $aula->aula_condition = $request->condition;
        $aula->is_active      = $request->is_active;
        $aula->is_booking     = false;
        $aula->update();

        if (!$aula) {
            return Redirect::back()->with('error_message', 'Ubah Aula gagal');
        }

        return redirect('aula')->with('message', 'Ubah Aula berhasil');
    }

    public function destroy($id)
    {
        $aula = Aula::findOrFail($id);
        
        // Check active book / reservation
        if ($aula->is_booking == 1) {
            return Redirect::back()->with('message', 'Maaf, masih terdapat booking atau reservasi yang aktif');
        }

        $aula->delete();

        return redirect('aula')->with('message', 'Hapus Aula berhasil');
    }

    public function listReservation()
    {
        $reservationAula = ReservationAula::with('aula')->paginate(20);
        
        return view('contents.aula.list-reservation', compact('reservationAula'));
    }

    public function reservation($id)
    {
        $aula = Aula::findOrFail($id);
        $generateReservationNumber = ReservationAula::generateRandom();

        return view('contents.aula.reservation', compact('aula', 'generateReservationNumber'));
    }

    public function reservationProcess(Request $request, $id)
    {
        $reservationAula = new ReservationAula();
        $reservationAula->aula_id = $id;
        $reservationAula->reservation_aula_number = $request->reservation_aula_number;
        $reservationAula->identity_card = $request->identity_card;
        $reservationAula->name = $request->name;
        $reservationAula->address = $request->address;
        $reservationAula->city = $request->city;
        $reservationAula->phone_number = $request->phone_number;
        $reservationAula->email = $request->email;
        $reservationAula->checkin_date = $request->checkin_date;
        $reservationAula->checkout_date = $request->checkout_date;
        $reservationAula->duration = $request->duration;
        $reservationAula->total_price = $request->total_price;
        $reservationAula->status = "booked";
        $reservationAula->operator = $request->operator;
        $reservationAula->save();

        if ($reservationAula) {
            $aula = Aula::findOrFail($id);
            $aula->is_booking = 1;
            $aula->update();

            return redirect('aula')->with('message', 'Reservasi Aula berhasil');
        }

        return Redirect::back()->with('error_message', 'Reservasi Aula gagal');
    }

    public function detailReservation($reservationId)
    {
        $reservationAula = ReservationAula::with('aula')->findOrFail($reservationId);

        return view('contents.aula.detail-reservation', compact('reservationAula'));
    }

    public function payment(Request $request, $reservationAulaId)
    {
        $reservationAula = ReservationAula::findOrFail($reservationAulaId);
        $reservationAula->status = "done";
        $reservationAula->update($request->all());

        if ($reservationAula) {
            // Update Status Aula
            $aula = Aula::find($request->aula_id);
            $aula->is_booking = 0;
            $aula->update();

            return redirect('aula')->with('message', 'Pembayaran Aula berhasil');
        }

        return Redirect::back()->with('error_message', 'Pembayaran Aula gagal');
    }

    public function print($reservationId)
    {
        $reservation = ReservationAula::find($reservationId);
        $aula = Aula::with('reservationAula')->findOrFail($reservation->aula_id);

        // return view('contents.aula.print', compact('aula'));
        $pdf = PDF::loadView('contents.aula.print', compact('aula'));
        $pdf->setPaper('A4', 'landscape');
        $filename = "invoice-aula-".$aula->reservationAula->reservation_aula_number;
        return $pdf->download($filename.".pdf");
    }
    
}