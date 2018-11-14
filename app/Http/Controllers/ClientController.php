<?php

namespace App\Http\Controllers;

use App\Client;
use App\Package;
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

        $package = Package::get();
        return view('client.show', compact('package'));
    }
    public function insert(Request $r){

        $client = new Client();
        $client->clientFirstName = $r->clientFirstName;
        $client->clientLastName = $r->clientLastName;
        $client->email = $r->email;
        $client->phone = $r->phone;
        $client->ip = $r->ip;
        $client->bandWide = $r->bandWidth ;
        $client->price = $r->price;
        $client->address = $r->address;
        $client->fkpackageId = $r->package;
        $client->save();
        Session::flash('message', 'Client Insert Successfully!');
        return back();
    }
    public function edit(Request $r){
        $client = Client::select('client.*', 'packageName')
            ->leftjoin('package','fkpackageId','packageId')
            ->where('clientId', $r->id)
            ->first();
        $package = Package::get();
        return view('client.edit', compact('client', 'package'));
    }

    public function update(Request $r , $id){
        $client = Client::findOrFail($id);
        $client->clientFirstName = $r->clientFirstName;
        $client->clientLastName = $r->clientLastName;
        $client->email = $r->email;
        $client->phone = $r->phone;
        $client->ip = $r->ip;
        $client->bandWide = $r->bandwidth ;
        $client->price = $r->price;
        $client->address = $r->address;
        $client->fkpackageId = $r->package;
        $client->save();
        Session::flash('message', 'Client Updated Successfully!');
        return back();
    }

    public function getData(Request $r){
        $client = Client::select('client.*', 'packageName')
            ->leftjoin('package','fkpackageId','packageId');
        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }
}
