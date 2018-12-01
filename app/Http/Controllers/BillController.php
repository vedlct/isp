<?php

namespace App\Http\Controllers;


use App\Bill;
use App\Client;
use App\InternetBill;
use App\InternetClient;
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


        $package = Package::get();

        return view('bill.show', compact('package','date'));
    }
    public function showWithData(Request $r){

        $bill = Bill::select('bill.fkclientId','client.clientFirstName','client.clientLastName','client.ip','client.bandWide','bill.price as billprice','bill.billId',DB::raw('DATE_FORMAT(bill.billdate,"%M-%Y") as billdate'),
            'client.address', 'package.packageName','bill.status as billStatus')
            ->leftjoin('client','bill.fkclientId','client.clientId')
            ->leftjoin('package','package.packageId','client.fkpackageId');

        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $bill= $bill->where(DB::raw('month(bill.billdate)'),$month);
        }
        if ($r->pastDue){

            $bill= $bill->where('bill.status','np');
        }

        $datatables = DataTables::of($bill);

        return $datatables->make(true);




    }

    public function showPastDue(){


        return view('bill.internet.showPastDue');
    }
    public function showPastDueLastMonth(){


        $LastMonth=Carbon::now()->subMonth()->format('F-Y');

        return view('bill.showPastDue',compact('LastMonth'));
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
        $bill=Bill::leftjoin('client','bill.fkclientId','client.clientId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
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

        $bill=Bill::leftjoin('client','bill.fkclientId','client.clientId')->where(DB::raw('month(billdate)'),$month)->where('client.clientId',$r->id)->first();
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


    /* internet Bill */
    public function internetBillShow(){

        $date=Carbon::now()->format('F-Y');

        $package = Package::get();
        $internetClient=InternetClient::where('internet_client.clientStatus',2)->count('internet_client.clientId');

        return view('bill.internet.show', compact('package','date','internetClient'));


    }

    public function internetBillShowWithData(Request $r){


        $bill = InternetBill::select('internet_bill.fkclientId','internet_client.clientFirstName','internet_client.clientLastName','internet_client.phone','internet_bill.price as billprice','internet_bill.billId',DB::raw('DATE_FORMAT(internet_bill.billdate,"%M-%Y") as billdate'),
            'internet_client.bandWide', 'package.packageName','internet_bill.status as billStatus')
            ->leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')
            ->leftjoin('package','package.packageId','internet_client.fkpackageId')
            ->where('internet_client.clientStatus',2);

        if ($r->billMonth){
            $month = Carbon::parse($r->billMonth)->format('m');
            $bill= $bill->where(DB::raw('month(internet_bill.billdate)'),$month);
        }
        if ($r->pastDue){

            $bill= $bill->where('internet_bill.status','np');
        }

        $datatables = DataTables::of($bill)->with('total', $bill->count('internet_client.clientId'));

        return $datatables->make(true);


    }

    public function internetBillPaid(Request $r){

//        $client = Client::findOrFail($r->id);
        $month = Carbon::parse($r->date)->format('m');
        $bill=InternetBill::leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->where(DB::raw('month(internet_bill.billdate)'),$month)->where('internet_client.clientId',$r->id)->first();
        $bill->status = 'p';
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS['Credit'];
        $report->price = $bill->price;
        $report->tabelId = $bill->billId;
        $report->date = $bill->billdate;
        $report->tableName = 'internet_bill';
        $report->save();

        $message='Monthly Internet bill of '.$r->date.' has been paid successfully for client Name '.$bill->clientFirstName.' '.$bill->clientLastName;

        return  $message;



    }

    public function generateInternetPdf($id,$date){

        $clientId=$id;

        $client=InternetClient::leftJoin('package','package.packageId','internet_client.fkpackageId')->findOrFail($clientId);
        $company=Company::first();

        $pdf = PDF::loadView('bill.pdf',compact('client','company','date'));

        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));




    }
    public function generateAllInternetBillPdf($date){

        $month = Carbon::parse($date)->format('m');
        $client=InternetBill::leftJoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->leftJoin('package','package.packageId','internet_client.fkpackageId')->where(DB::raw('month(internet_bill.billdate)'),$month)->get();
        $company=Company::first();



        $pdf = PDF::loadView('bill.internet.allBillPdf',compact('client','company','date'));


        return $pdf->stream('bill' . '.pdf', array('Attachment' => 0));




    }

    public function internetBillDue(Request $r){


        $month = Carbon::parse($r->date)->format('m');

        $bill=InternetBill::leftjoin('internet_client','internet_bill.fkclientId','internet_client.clientId')->where(DB::raw('month(internet_bill.billdate)'),$month)->where('internet_client.clientId',$r->id)->first();
        $bill->status = 'np';
        $bill->save();

        $report = Report::where('tabelId' , $bill->billId)
            ->where('tableName', 'internet_bill')->delete();

        $message='Monthly Internet bill of '.$r->date.' for client Name '.$bill->clientFirstName.' '.$bill->clientLastName.' has been changed to unpaid';

        return  $message;





    }

}
