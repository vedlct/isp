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

class BillController extends Controller
{

    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){

        $client = Client::get();
        $bill = Bill::get();
        $package = Package::get();
        return view('bill.show', compact('client', 'bill', 'package'));
    }
    public function paid(Request $r){

        $client = Client::findOrFail($r->id);

        $bill = new Bill();
        $bill->price =  $client->first()->price;
        $bill->fkclientId =  $r->id;
        $bill->save();

        $report = new Report();
        $report->status = ACCOUNT_STATUS[0];
        $report->price = $client->first()->price;
        $report->tabelId = $bill->billId;
        $report->tableName = 'bill';
        $report->save();

        return  ;



    }


    public function generatePdf(){
        $clientId=1;

        $client=Client::findOrFail($clientId);
        $company=Company::first();

//        return view('bill.pdf',compact('client','company'));

        $pdf = PDF::loadView('bill.pdf',compact('client','company'));

        return $pdf->stream();




    }

}
