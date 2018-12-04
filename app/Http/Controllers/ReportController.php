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
        $totalOFCurrentMonth=number_format($totalOFCurrentMonth,2);
        return view('report.showCredit',compact('totalOFCurrentMonth'));
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
        $credit=$credit->sum('report.price');


        return number_format($credit,2);
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

        $credit=Report::select('report.reportId','report.price','report.date','report.status')

            ->where('report.status',ACCOUNT_STATUS['Credit']);

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
        $report = Report::
//        select('report.*','reportDebitSalary2.employeeName','reportDebitSalary2.degisnation',
//            'reportDebitSalary2.phone','reportDebitSalary2.email',
////            'cable_client.clientFirstName','cable_client.address','cable_client.clientLastName','cable_client.email','cable_client.phone',
////            'internet_client.clientFirstName','internet_client.address','internet_client.clientLastName','internet_client.email','internet_client.phone',
//            'reportDebitExpense1.expenseType',
//            'reportDebitExpense1.amount','reportDebitExpense1.cause','reportDebitExpense1.price as expensePrice')
////            DB::raw('CASE WHEN report.status = "'.ACCOUNT_STATUS['Credit'].'" AND report.tableName ="cable_bill"  THEN cablebillCredit.billId
////            WHEN report.status = "'.ACCOUNT_STATUS['Credit'].'" AND report.tableName ="internet_bill" THEN internetbillCredit.billId
////            WHEN report.status = "'.ACCOUNT_STATUS['Debit'].'" AND report.tableName ="employee" THEN reportDebitSalary2.employeeId
////            WHEN report.status = "'.ACCOUNT_STATUS['Debit'].'" AND report.tableName ="expense" THEN reportDebitExpense1.expenseId END Name'))
//
////            ->join('cable_bill as cablebillCredit', 'cablebillCredit.billId', '=', 'report.tabelId')
////                ->join('cable_client',function($join) {
////                    $join->on('cable_client.clientId', '=', 'cablebillCredit.fkclientId');
////
////                })
////
//            ->join('internet_bill as internetbillCredit', 'internetbillCredit.billId', '=', 'report.tabelId')
//                ->join('internet_client',function($join) {
//                    $join->on('internet_client.clientId', '=', 'internetbillCredit.fkclientId');
//
//                })
//
////            ->leftJoin('cable_bill as cablebillCredit', 'cablebillCredit.billId', '=', 'report.tabelId')
////            ->leftJoin('internet_bill as internetbillCredit', 'internetbillCredit.billId', '=', 'report.tabelId')
////            ->leftJoin('cable_client', 'cable_client.clientId', '=', 'cablebillCredit.fkclientId')
////            ->leftJoin('internet_client as internetClient', 'internetClient.clientId', '=', 'internetbillCredit.fkclientId')
//
//            ->leftJoin('expense as reportDebitExpense1', 'reportDebitExpense1.expenseId', '=', 'report.tabelId')
//            ->leftJoin('employee as reportDebitSalary2', 'reportDebitSalary2.employeeId', '=', 'report.tabelId')

//            ->findOrFail($reportId);
            findOrFail($reportId);

        if ($report->tableName == 'cable_bill'){

            $report=$report->join('cable_bill', function($join) use ($report){
                $join->on('cable_bill.billId', '=', 'report.tabelId');
                $join->where('report.tabelId', '=', $report->tabelId);
                })->join('cable_client',function($join) {
                    $join->on('cable_client.clientId', '=', 'cable_bill.fkclientId');

                })->get();
        }
//        if ($report->tableName=='internet_bill'){
//
//            $report=$report->leftJoin('internet_bill as internetbillCredit', 'internetbillCredit.billId', '=', 'report.tabelId')
//                ->join('internet_client',function($join) {
//                    $join->on('internet_client.clientId', '=', 'internetbillCredit.fkclientId');
//
//                });
//        }

        return $report;


        return view('report.showDetails',compact('report','reportId'));


    }

}
