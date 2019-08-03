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
use App\Entities\Room\Room;
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

        if (!is_null($request->start_date)) {
            $startDate = Carbon::parse($request->start_date)->format("Y-m-d H:i:s");
            $endDate = Carbon::parse($request->end_date)->format("Y-m-d H:i:s");
            $query->whereBetween('checkin_date', [$startDate, $endDate]);
        }

        if (!is_null($request->name)) {
            $query->where('name', 'like', '%'. $request->name .'%');
        }

        if (!is_null($request->reservation_number)) {
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
        $totalIncome = ReservationCost::totalIncome();
        $incomeLastMonth = ReservationCost::totalIncomeMonthly();
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

    public function incomeReport($type) 
    {
        if ($type == "monthly") {
            $totalIncomes = ReservationCost::totalIncomeMonthly();
            $incomes = ReservationCost::incomeMonthly();

            $pdf = PDF::loadView('contents.report.report-income', compact('incomes', 'totalIncomes'));
            $pdf->setPaper('A4', 'landscape');
            $filename = "report-income-". Carbon::now()->format("Y-m-d");

            return $pdf->download($filename.".pdf");
        } else {
            $totalIncomes   = ReservationCost::totalIncome();
            $incomes        = ReservationCost::with(['reservationCost', 'roomByRoomNumber', 'reservationAdditionalCosts'])->get();
            $firstData      = ReservationCost::firstData();
            $latest         = ReservationCost::latestData();

            $pdf = PDF::loadView('contents.report.report-income', compact('incomes', 'totalIncomes', 'firstData', 'latestData'));
            $pdf->setPaper('A4', 'landscape');
            $filename = "report-income-". Carbon::now()->format("Y-m-d");

            return $pdf->download($filename.".pdf");
        }        
    }
}
