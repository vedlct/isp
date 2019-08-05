<?php

namespace App\Http\Controllers;

use App\Bill;
use App\CableBill;
use App\CableClient;
use App\CheckMonth;
use App\Client;
use App\Employee;
use App\InternetBill;
use App\InternetClient;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        ///////////////////////////////internet//////////////////////////////////

        $date = new Carbon();
        $this_month = $date->format('m');
        $totalbilllastmonthinternet =InternetBill::select(DB::raw('SUM(price) as totalbillinternet'))->where('status', 'ap')->where(DB::raw('MONTH(billdate)'), $this_month)->first();
        $totalduelastmonthinternet =InternetBill::select(DB::raw('SUM(price) as totaldueinternet'))->where('status', 'np')->where(DB::raw('MONTH(billdate)'), $this_month)->first();
        $totalpastduelastmonthinternet =InternetBill::select(DB::raw('SUM(internet_bill.price) as totalpastdueinternet'))->leftjoin('internet_client','clientId','fkclientId')->where('internet_client.clientStatus',2)->where('status', 'np')->first();

        $totalOFLastMonthDebits=Report::leftjoin('expense' , 'tabelId', 'expenseId')
            ->leftjoin('employee' , 'tabelId', 'employeeId')
            ->leftjoin('user' , 'userId', 'fkUserId')
            ->where('report.status',ACCOUNT_STATUS['Debit'])
            ->where('tableName' , 'employee')
            ->where('fkusertype','InternetEmp')
            ->orWhere('tableName', 'expense')
            ->where('expenseFor','Internet')
            ->whereMonth('report.date', ((Carbon::now())->month))
            ->sum('report.price');

        $totalOFLastMonthDebit=number_format($totalOFLastMonthDebits,2);

        $totalOFLastMonthCredits=Report::where('report.status',ACCOUNT_STATUS['Credit'])
            ->where('tableName','internet_bill')
           // ->whereMonth('report.date', ((Carbon::now())->month))
            ->whereMonth('report.date', '8')
            ->sum('report.price');
        $totalOFLastMonthCredit=number_format($totalOFLastMonthCredits,2);



        $summary = $totalOFLastMonthCredits - $totalOFLastMonthDebits;
        $summary = number_format($summary,2);


        //////////////////////////////Cable/////////////////////////


        $totalbilllastmonthcable =CableBill::select(DB::raw('SUM(price) as totalbillcable'))->where('status', 'ap')->where(DB::raw('MONTH(billdate)'), $this_month)->first();
        $totalduelastmonthcable =CableBill::select(DB::raw('SUM(price) as totalduecable'))->where('status', 'np')->where(DB::raw('MONTH(billdate)'), $this_month)->first();
        $totalpastduelastmonthcable =CableBill::select(DB::raw('SUM(price) as totalpastduecable'))->where('status', 'np')->first();

        $totalOFLastMonthDebitscable=Report::leftjoin('expense' , 'tabelId', 'expenseId')
            ->leftjoin('employee' , 'tabelId', 'employeeId')
            ->leftjoin('user' , 'userId', 'fkUserId')
            ->where('report.status',ACCOUNT_STATUS['Debit'])
            ->where('tableName' , 'employee')
            ->where('fkusertype','CableEmp')
            ->orWhere('tableName', 'expense')
            ->where('expenseFor','Cable')
            ->whereMonth('report.date', ((Carbon::now())->month))
            ->sum('report.price');

        $totalOFLastMonthDebitcable=number_format($totalOFLastMonthDebitscable,2);

        $totalOFLastMonthCreditscable=Report::where('report.status',ACCOUNT_STATUS['Credit'])
            ->where('tableName', 'cable_bill')
            ->whereMonth('report.date', ((Carbon::now())->month))
            ->sum('report.price');
        $totalOFLastMonthCreditcable=number_format($totalOFLastMonthCreditscable,2);

        $summarycable = $totalOFLastMonthCreditscable - $totalOFLastMonthDebitscable;
        $summarycable = number_format($summarycable,2);


        return view('index', compact('totalbilllastmonthinternet','totalduelastmonthinternet', 'totalpastduelastmonthinternet', 'totalOFLastMonthDebit', 'totalOFLastMonthCredit' , 'summary','totalbilllastmonthcable','totalduelastmonthcable','totalpastduelastmonthcable','totalOFLastMonthDebitcable','totalOFLastMonthCreditcable','summarycable'));
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

//            DB::select(DB::raw("INSERT INTO cable_bill (`billdate`, `price`, `status`, `fkclientId`)
//                    SELECT '".Carbon::now()->subMonth()->format('Y-m-d')."',`price`,'np',`clientId` FROM `cable_client` where cable_client.clientStatus=2"));

            $client = InternetClient::select('clientId', 'price')->where('clientStatus',2)->get();
            foreach ($client as $c) {
                $bill = new InternetBill();
                $bill->billdate = date('Y-m-d');
                $bill->price = $c->price;
                $bill->status = 'np';
                $bill->fkclientId = $c->clientId ;
                $bill->save();
            }

            $clientcable = CableClient::select('clientId', 'price')->where('clientStatus',2)->get();
            foreach ($clientcable as $cc) {
                $billcable = new CableBill();
                $billcable->billdate = Carbon::now()->format('Y-m-d');
                $billcable->price = $cc->price;
                $billcable->status = 'np';
                $billcable->fkclientId = $cc->clientId ;
                $billcable->save();
            }

//            DB::select(DB::raw("INSERT INTO internet_bill (`billdate`, `price`, `status`, `fkclientId`)
//              SELECT '".  date('Y-m-d')."',`price`,'np',`clientId` FROM `internet_client` where internet_client.clientStatus=2"));

            $employee = Employee::select('employeeId')->where('status',1)->get();

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
