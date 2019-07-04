<?php

namespace App\Http\Controllers;

use App\Package;
use App\Report;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;
use Carbon\Carbon;
use DB;


class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDebit(){

        $totalOFCurrentMonth=Report::where('report.status',ACCOUNT_STATUS['Debit'])->whereMonth('report.date', Carbon::now()->month)->sum('report.price');
        $totalOFCurrentMonth=number_format($totalOFCurrentMonth,2);
        return view('report.showDebit',compact('totalOFCurrentMonth'));
    }
    public function showCredit(){

        $totalOFCurrentMonth=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', Carbon::now()->month)->sum('report.price');
        $totalDiscountOFCurrentMonth=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', Carbon::now()->month)->sum('report.discount');
        $totalRecievedOFCurrentMonth=Report::where('report.status',ACCOUNT_STATUS['Credit'])->whereMonth('report.date', Carbon::now()->month)->sum('report.partial');
        $totalOFCurrentMonth=number_format($totalOFCurrentMonth,2);
        $totalDiscountOFCurrentMonth=number_format($totalDiscountOFCurrentMonth,2);
        $totalRecievedOFCurrentMonth=number_format($totalRecievedOFCurrentMonth,2);
        return view('report.showCredit',compact('totalOFCurrentMonth','totalDiscountOFCurrentMonth','totalRecievedOFCurrentMonth'));
    }

    public function getTotalDebitSum(Request $r){


        $debit=Report::where('report.status',ACCOUNT_STATUS['Debit']);

        if ($r->dateFilterFrom){
            $debit=$debit->where('report.date','>=',$r->dateFilterFrom);
        }
        if ($r->dateFilterTo){
            $debit=$debit->where('report.date','<=',$r->dateFilterTo);
        }
        $debit=$debit->sum('report.price');


        return number_format($debit,2);
    }
    public function getTotalCreditSum(Request $r){


        $credit=Report::where('report.status',ACCOUNT_STATUS['Credit']);


        if ($r->dateFilterFrom){
            $credit=$credit->where('report.date','>=',$r->dateFilterFrom);
        }
        if ($r->dateFilterTo){
            $credit=$credit->where('report.date','<=',$r->dateFilterTo);
        }
        $credit1=$credit->sum('report.price');
        $creditDiscount=$credit->sum('report.discount');
        $creditRecievedAmount=$credit->sum('report.partial');

        $credit2=number_format($credit1,2);
        $creditDiscount=number_format($creditDiscount,2);
        $creditRecievedAmount=number_format($creditRecievedAmount,2);

        $data=array(
          'totalAmountSum'=>$credit2,
          'totalDiscountSum'=>$creditDiscount,
          'totalRecievedSum'=>$creditRecievedAmount,
        );



        return $data;
    }

    public function getDebitData(Request $r){

        $debit=Report::select('report.reportId','report.price','report.date','report.status','report.tableName',
            'reportDebitExpense1.expenseType','report.tabelId')
            ->leftJoin('expense as reportDebitExpense1', 'reportDebitExpense1.expenseId', '=', 'report.tabelId')
            ->where('report.status',ACCOUNT_STATUS['Debit']);

        if ($r->currentMonth){
            $debit=$debit->whereMonth('report.date', Carbon::now()->month);

        }
        else{

            if ($r->dateFilterFrom){
                $debit=$debit->where('report.date','>=',$r->dateFilterFrom);
            }
            if ($r->dateFilterTo){
                $debit=$debit->where('report.date','<=',$r->dateFilterTo);
            }


        }
        if ($r->statusFilter){
            $debit=$debit->where('reportDebitExpense1.expenseType',$r->statusFilter);
        }

        $datatables = DataTables::of($debit);

        return $datatables->make(true);


    }
    public function getCreditData(Request $r){

        $credit=Report::select('report.reportId',
            DB::raw('SUM(report.price) as price'),DB::raw('SUM(report.partial) as partial'),
            DB::raw('SUM(report.discount) as discount'),'report.date','report.status')
            ->where('report.status',ACCOUNT_STATUS['Credit'])

            ->groupBy("report.tableName","report.tabelId");

        if ($r->currentMonth){
            $credit=$credit->whereMonth('report.date', Carbon::now()->month);
        }
        else{

            if ($r->dateFilterFrom){
                $credit=$credit->where('report.date','>=',$r->dateFilterFrom);
            }
            if ($r->dateFilterTo){
                $credit=$credit->where('report.date','<=',$r->dateFilterTo);
            }

        }

        $datatables = DataTables::of($credit);

        return $datatables->make(true);


    }
    public function showDetailsReport(Request $r){

        $reportId=$r->id;
        $report = Report::findOrFail($reportId);

        if ($report->tableName == 'cable_bill'){

            $report=Report::select('report.*',DB::raw('SUM(report.price) as Totalprice'),DB::raw('SUM(report.partial) as partial'),DB::raw('SUM(report.discount) as discount'),
                'cable_client.clientFirstName','cable_client.clientLastName',
                'cable_client.email','cable_client.phone','cable_client.price','cable_client.address')
                ->leftJoin('cable_bill','cable_bill.billId','report.tabelId')
                ->leftJoin('cable_client','cable_client.clientId','cable_bill.fkclientId')
                ->groupBy("report.tableName",'report.tabelId')
                ->where('report.tabelId',$report->tabelId)
                ->first();

        }
        elseif ($report->tableName=='internet_bill'){

            $report=Report::select('report.*',DB::raw('SUM(report.price) as Totalprice'),DB::raw('SUM(report.partial) as partial'),DB::raw('SUM(report.discount) as discount'),'internet_client.clientFirstName','internet_client.clientLastName',
                'internet_client.email','internet_client.phone','internet_client.price','internet_client.address')
                ->leftJoin('internet_bill','internet_bill.billId','report.tabelId')
                ->leftJoin('internet_client','internet_client.clientId','internet_bill.fkclientId')
                ->groupBy("report.tableName",'report.tabelId')
                ->where('report.tabelId',$report->tabelId)
                ->first();
        }

        elseif ($report->tableName=='employee'){

            $report=$report->select('report.*','employee.employeeName','employee.degisnation',
                'employee.phone','employee.email','employee.price')
                ->leftJoin('employee','employee.employeeId','report.tabelId')
                ->findOrFail($reportId);

        }

        elseif ($report->tableName=='expense'){
            $report=$report->select('report.*','expense.*')
                ->leftJoin('expense','expense.expenseId','report.tabelId')
                ->findOrFail($reportId);

        }

//        return $report;


        return view('report.showDetails',compact('report','reportId'));


    }
    /* summary */

    public function showSummary(){


        return view('report.showSummary');
    }


}
