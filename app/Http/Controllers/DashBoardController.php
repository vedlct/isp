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


//        $client = Client::select('clientId')->get();
//        $count = 0;
//        for ($i =1 ; $i<13 ; $i++) {
//
//            //   $bill = Bill::get();
//
//
//            foreach ($client as $c){
//                $bill = Bill::where(DB::raw('month(billdate)'), $i)
//                    ->where('fkclientId', $c->clientId)->first();
//                if( !$bill){
//                    $count = $count+ 1;
//                }
//            }
//        }
//
//        return $count;

//        $client = Client::select('clientId')->get();
//        $count = 0;
//        $bill = Bill::get();
//        for ($i =1 ; $i<13 ; $i++) {
//
//            //   $bill = Bill::get();
//
//
//            foreach ($client as $c){
//                foreach ($bill as $b){
//                    $month = date('m', strtotime($b->billdate));
//                    if (!($month == $i && $c->clientId == $b->fkclientId)){
//                        $count = $count+1;
//                    }
//                }
//            }
//        }
//
//        return $count;

        $totalOFLastMonthDebit=Report::where('report.status',ACCOUNT_STATUS['Debit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
        $totalOFLastMonthDebit=number_format($totalOFLastMonthDebit,2);

        $totalOFLastMonthCredit=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', ((Carbon::now()->subMonth())->month))->sum('report.price');
        $totalOFLastMonthCredit=number_format($totalOFLastMonthCredit,2);

        return view('index',compact('totalOFLastMonthCredit','totalOFLastMonthDebit'));
    }

    public function previousdue(){
        $client = Client::select('clientId')->get();
        $count = 0;
        for ($i =1 ; $i<13 ; $i++) {

            foreach ($client as $c){
                $bill = Bill::where(DB::raw('month(billdate)'), $i)
                    ->where('fkclientId', $c->clientId)->first();
               if(!$bill){
                   $count = $count+ 1;
                }
            }

        }

        return $count;
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
                $bill->fkclientId = $c->price ;
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
