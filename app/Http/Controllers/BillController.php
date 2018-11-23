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
use Yajra\DataTables\DataTables;
class BillController extends Controller
{

    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $date=Carbon::now()->format('F-Y');


//        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice', 'address', 'packageName')
//            ->leftjoin('package','packageId','fkpackageId')
//            ->get();
//
//        $bill = Bill::get();

        $package = Package::get();

        return view('bill.show', compact('package','date'));
    }
    public function showWithData(Request $r){

        $client = Client::select('clientId','clientFirstName','clientLastName','ip','bandWide','client.price as cprice',
            'address', 'package.packageName','bill.status as billStatus')
            ->leftjoin('package','packageId','fkpackageId')
            ->leftjoin('bill','bill.billId','client.clientId');

        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $client= $client->where(DB::raw('month(bill.billdate)'),$month);
        }

        $datatables = DataTables::of($client);

        return $datatables->make(true);




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

//        $client = Client::findOrFail($r->id);
        $month = Carbon::parse($r->date)->format('m');
        $bill=Bill::leftjoin('client','client.clientId','bill.billId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'bill';
        $report->save();

        $message='Monthly bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;

        return  $message;



    }
    public function due(Request $r){

//        $client = Client::findOrFail($r->id);
        $month = Carbon::parse($r->date)->format('m');

        $bill=Bill::leftjoin('client','client.clientId','bill.billId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->save();

        $report = Report::where('tabelId' , $bill->billId)
        ->where('tableName', 'bill')->delete();

        $message='Monthly bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';

        return  $message;





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
