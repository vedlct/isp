<?php

namespace App\Http\Controllers;


use App\Bill;
use App\Client;
use App\Package;

//use App\Client;
use App\Company;

use App\Report;
use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
class BillController extends Controller
{

    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $date=Carbon::now()->startOfMonth()->format('Y-m-d');


        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice', 'address', 'packageName')
            ->leftjoin('package','packageId','fkpackageId')
        ->get();
        $bill = Bill::get();
        $package = Package::get();
        return view('bill.show', compact('client', 'bill', 'package','date'));
    }
    public function showPastDue(){
        $date=Carbon::now()->startOfMonth()->format('Y-m-d');

        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice', 'address', 'packageName')
            ->leftjoin('package','packageId','fkpackageId')
        ->get();
        $bill = Bill::get();
        $package = Package::get();
        return view('bill.showPastDue', compact('client', 'bill', 'package','date'));
    }

    public function showDate($date){
        $currentMonth = Carbon::parse($date)->format('m');


        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice', 'address', 'packageName')
            ->leftjoin('package','packageId','fkpackageId')
        ->get();
        $bill = Bill::where(DB::raw('month(billdate)'),$currentMonth)->get();

        $package = Package::get();
        return view('bill.show', compact('client', 'bill', 'package','date'));
    }


    public function paid(Request $r){

        $client = Client::findOrFail($r->id);

        $bill = new Bill();
        $bill->price =  $client->first()->price;
        $bill->fkclientId =  $r->id;
        $bill->billdate =  $r->date;
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $client->first()->price;
        $report->tabelId = $bill->billId;
        $report->date = $r->date;
        $report->tableName = 'bill';
        $report->save();

        return  $report;



    }
    public function due(Request $r){

        $client = Client::findOrFail($r->id);

        $bill = Bill::where('fkclientId' , $client->clientId)->where('billdate',$r->date)->first();
//        $bill->delete();

        $report = Report::where('tabelId' , $bill->billId)
        ->where('tableName', 'bill')->delete();

        $bill = Bill::where('fkclientId' , $client->clientId)->where('billdate',$r->date)->delete();


//        $report = Report::where('tabelId' , $bill->first()->billId)
//        ->where('tableName', 'bill');

//        $report->delete();

        return  0;



    }


    public function generatePdf($id,$date){
        $clientId=$id;
//        $date=$date;

        $client=Client::leftJoin('package','package.packageId','client.fkpackageId')->findOrFail($clientId);
        $company=Company::first();


        $pdf = PDF::loadView('bill.pdf',compact('client','company','date'));

//        return $pdf->stream();
        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));




    }

}
