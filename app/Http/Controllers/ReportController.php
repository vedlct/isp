<?php

namespace App\Http\Controllers;

use App\Package;
use App\Report;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;


class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDebit(){

//        Report::get();

//        $debit=Report::where('report.status',ACCOUNT_STATUS['Debit'])->sum('report.price');

        return view('report.showDebit');
    }
    public function getTotalDebitSum(Request $r){

        $from=$r->filterData['dateFilterFrom'];
        $to=$r->filterData['dateFilterTo'];

        


        $debit=Report::where('report.status',ACCOUNT_STATUS['Debit'])->whereBetween('report.date', [$from, $to])->sum('report.price');

        return view('report.showDebit');
    }
    public function getDebitData(Request $r){

        $debit=Report::select('report.price','report.date','report.status')

            ->where('report.status',ACCOUNT_STATUS['Debit']);

//        if ($r->genderFilter){
//            $cvData= $cvData->where('employee.gender',$r->genderFilter);
//        }
//        if ($r->religionFilter){
//            $cvData= $cvData->where('employee.fkreligionId',$r->religionFilter);
//        }
//        if ($r->ethnicityFilter){
//            $cvData= $cvData->where('employee.ethnicityId',$r->ethnicityFilter);
//        }
//
//        if ($r->ageFromFilter){
//            $cvData= $cvData->having('age1','>=',$r->ageFromFilter);
//        }
//        if ($r->ageToFilter){
//            $cvData= $cvData->having('age1','<=',$r->ageToFilter);
//        }

        $debit=$debit->get();

        $datatables = DataTables::of($debit);

        return $datatables->make(true);


    }

}
