<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;

class ClientController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){

        return view('client.show');
    }
    public function edit(){

    }

    public function getData(Request $r){
        $client = Client::select('client.*', 'packageName')
            ->leftjoin('package','fkpackageId','packageId')
        ->get();
        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }
}
