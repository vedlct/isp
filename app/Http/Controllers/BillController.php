<?php

namespace App\Http\Controllers;


use App\Bill;
use App\Client;
use App\Package;

//use App\Client;
use App\Company;

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


    public function generatePdf(){
        $clientId=1;

        $client=Client::findOrFail($clientId);
        $company=Company::first();

//        return view('bill.pdf',compact('client','company'));

        $pdf = PDF::loadView('bill.pdf',compact('client','company'));

        return $pdf->stream();




    }

}
