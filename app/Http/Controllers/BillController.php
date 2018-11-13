<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Client;
use App\Package;
use Illuminate\Http\Request;

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

}
