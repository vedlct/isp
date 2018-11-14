<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use Illuminate\Http\Request;
use PDF;

class BillController extends Controller
{
    public function generatePdf(){
        $clientId=1;

        $client=Client::leftJoin('package','package.packageId','client.fkpackageId')->findOrFail($clientId);
        $company=Company::first();


        $pdf = PDF::loadView('bill.pdf',compact('client','company'));

        return $pdf->stream();




    }
}
