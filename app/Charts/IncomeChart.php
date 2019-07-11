<?php
namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Carbon\Carbon;
use DB;
use App\Entities\ReservationCost;

class IncomeChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static function income()
    {
        
    }
}
