<?php

namespace App\Http\Controllers;

use App\CablePackage;
use App\ClientFile;
use App\InternetClient;
use App\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Auth;
class InternetClientController extends Controller
{
    public function index(){
        $package = Package::get();
        $cablepackage = CablePackage::get();
        return view('internet-client.index', compact('package','cablepackage'));
    }


    public function getData(Request $r){
        $client = InternetClient::select('internet_client.*', 'packageName')
            ->leftjoin('package','fkpackageId','packageId');
        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }

    public function insert(Request $r){
        $client = new InternetClient();
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
        $index=0;
        foreach($r->file('clientImage') as $image){
            $fileName=$r->clientFile[$index];
            $index++;

            $name=$fileName.time().$image->getClientOriginalName();


            $empid=$client->clientId;
            $empDir="documents".'/internet_client';
            if (!file_exists(public_path($empDir))){
                mkdir(public_path($empDir), 0777, true);
            }


            $image->move(public_path($empDir), $name);
            $document = new ClientFile();
            $document->clienId = $empid;
            $document->name =$fileName;
            $document->uploadedBy = Auth::user()->userId;
            $document->path =$empDir.'/'.$name;
            $document->tableName="internet_client";
            $document->save();
        }

        return back();
    }

    public function edit(Request $r){
        $client = InternetClient::select('internet_client.*', 'packageName')
            ->leftjoin('package','fkpackageId','packageId')
            ->where('clientId', $r->id)
            ->first();
        $package = Package::get();
        $documents=ClientFile::where('tableName','internet_client')
            ->where('clienId',$r->id)
            ->get();
        return view('client.edit', compact('client', 'package','documents'));
    }

    public function update(Request $r , $id){
//        return $r;
        $client = InternetClient::findOrFail($id);
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

        $index=0;
        foreach($r->file('clientImage') as $image){
            $fileName=$r->clientFile[$index];
            $index++;

            $name="test".$image->getClientOriginalName();


            $empid=$client->clientId;
            $empDir="documents".'/internet_client';
            if (!file_exists(public_path($empDir))){
                mkdir(public_path($empDir), 0777, true);
            }


            $image->move(public_path($empDir), $name);
            $document = new ClientFile();
            $document->clienId = $empid;
            $document->name =$fileName;
            $document->uploadedBy = Auth::user()->userId;
            $document->path =$empDir.'/'.$name;
            $document->tableName="internet_client";
            $document->save();
        }
        return back();
    }

    public function deleteFile(Request $r){
        $clientFile=ClientFile::findOrFail($r->id);
        $clientId=$clientFile->clienId;
        $clientFile->delete();
        return $clientId;
    }
}