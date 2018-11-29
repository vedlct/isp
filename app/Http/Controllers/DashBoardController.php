<?php

namespace App\Http\Controllers;

use App\Bill;
use App\CheckMonth;
use App\Client;
use App\Employee;
use App\Report;
use App\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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


//        $totalOFLastMonthDebit=Report::where('report.status',ACCOUNT_STATUS['Debit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
//        $totalOFLastMonthDebit=number_format($totalOFLastMonthDebit,2);
//
//        $totalOFLastMonthCredit=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
//        $totalOFLastMonthCredit=number_format($totalOFLastMonthCredit,2);
//
//        $totalBillRecievedOFLastMonth=Report::where('report.status',ACCOUNT_STATUS['Credit'])->where('report.tableName','bill')->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->groupBy('report.tabelId')->count('report.reportId');
//        $totalBillDueOFLastMonth=Bill::where('bill.status','np')->whereMonth('bill.billdate',((Carbon::now()->subMonth())->month))->count('bill.billId');



//        return view('index',compact('totalOFLastMonthCredit','totalOFLastMonthDebit','totalBillRecievedOFLastMonth','totalBillDueOFLastMonth'));

        return view('index');
    }

    public function previousdue(){

        $bill = Bill::where('bill.status','np')->count('bill.billId');
        return $bill;
    }

    public function insertbillformonth()
    {
        $n = CheckMonth::where(DB::raw('month(date)'), date('m') )->where(DB::raw('Year(date)'), date('Y') )->first();

        if($n){
        }
        else{


            $checkmonthinsert = new CheckMonth();
            $checkmonthinsert->date = date('Y-m-d');
            $checkmonthinsert->save();


            $client = Client::select('clientId', 'price')->get();
            foreach ($client as $c) {
                $bill = new Bill();
                $bill->billdate = date('Y-m-d');
                $bill->price = $c->price;
                $bill->status = 'np';
                $bill->fkclientId = $c->clientId ;
                $bill->save();
            }
            $employee = Employee::select('employeeId')->get();
            foreach ($employee as $em){
                $salaryinsert = new Salary();
                $salaryinsert->fkemployeeId = $em->employeeId;
                $salaryinsert->date = date('Y-m-d');
                $salaryinsert->status = 'np';
                $salaryinsert->save();
            }


        }

    }

}
