<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use Cache;
use Session;
use PDF;
use DB;

use App\User;
use App\Entities\Reservation;
use App\Entities\ReservationCost;
use App\Entities\ReservationAdditionalCost;
use App\Entities\Room;
use App\Entities\Service;
use App\Entities\Room\RoomBedType;
use App\Entities\Room\RoomCondition;
use App\Entities\Room\RoomType;
use App\Charts\IncomeChart;

class ReportController extends Controller
{
    public function transaction(Request $request)
    {
        
        $query = Reservation::with(['reservationCost', 'roomByRoomNumber', 'reservationAdditionalCosts']);
        if ($request->has('start_date')) {
            $startDate = Carbon::parse($request->start_date)->format("Y-m-d H:i:s");
            $endDate = Carbon::parse($request->end_date)->format("Y-m-d H:i:s");

            $query->whereBetween('checkin_date', [$startDate, $endDate]);
        }

        if ($request->has('customer')) {
            $query->where('name', '%'. $request->customer .'%');
        }

        if ($request->has('reservation_number')) {
            $query->where('reservation_number', 'like', '%'. $request->reservation_number .'%');
        }

        $reservations = $query->paginate(30);

        if ($request->has('print')){
            // return view('contents.report.report', compact('reservations'));
            $pdf = PDF::loadView('contents.report.report', compact('reservations'));
            $pdf->setPaper('A4', 'landscape');
            $filename = "repert-". Carbon::now()->format("Y-m-d");
            return $pdf->download($filename.".pdf");
        }

        return view('contents.report.transaction', compact('reservations'));
    }
    
    public function income()
    {
        $totalIncome = ReservationCost::sum('total_price');
        $incomeLastMonth = ReservationCost::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        $incomeBeforeLastMonth = ReservationCost::whereMonth('created_at', '<' ,Carbon::now()->month)->sum('total_price');

        $chart = new IncomeChart();
        $data = ReservationCost::select(
                            DB::raw('sum(total_price) as sums'), 
                            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->groupBy('months')->get();

        $months = [];
        $incomes = [];
        foreach ($data as $value) {
            $months[] = $value->months;
            $incomes[] = $value->sums;
        }

        $chart->labels($months);
        $chart->dataset('Grafik Pendepatan Perbulan', 'line', $incomes);

        return view('contents.report.income', compact('totalIncome', 'incomeLastMonth', 'incomeBeforeLastMonth', 'chart'));

    }
}
