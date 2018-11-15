<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalOFLastMonthDebit=Report::where('report.status',ACCOUNT_STATUS['Debit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
        $totalOFLastMonthDebit=number_format($totalOFLastMonthDebit,2);

        $totalOFLastMonthCredit=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
        $totalOFLastMonthCredit=number_format($totalOFLastMonthCredit,2);

        return view('index',compact('totalOFLastMonthCredit','totalOFLastMonthDebit'));
    }

}
