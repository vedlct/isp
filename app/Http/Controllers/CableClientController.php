<?php

namespace App\Http\Controllers;

use App\CableClient;
use App\ClientFile;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Auth;
class CableClientController extends Controller
{
    public function index(){

        return view('cable-client.index');
    }

    public function getData(Request $r){
        $client=CableClient::get();
        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }
    public function insert(Request $r){



        $client=new CableClient();
        $client->clientFirstName=$r->clientFirstName;
        $client->clientLastName=$r->clientLastName;
        $client->email=$r->email;
        $client->phone=$r->phone;
        $client->address=$r->address;
        $client->cableLength=$r->cableLength;
        $client->clientSerial=$r->clientSerial;
        $client->noOfTv=$r->noOfTv;
        $client->conDate=$r->conDate;
        $client->price=$r->price;
        $client->save();
        Session::flash('message', 'Client Insert Successfully!');

        $index=0;
        if($r->clientImage){


        foreach($r->file('clientImage') as $image){
            $fileName=$r->clientFile[$index];
            $index++;

            $name=$fileName.time().$image->getClientOriginalName();


            $empid=$client->clientId;
            $empDir="documents".'/cable_client';
            if (!file_exists($empDir)){
                mkdir(public_path($empDir), 0777, true);
            }


            $image->move(public_path($empDir), $name);
            $document = new ClientFile();
            $document->clienId = $empid;
            $document->name =$fileName;
            $document->uploadedBy = Auth::user()->userId;
            $document->path =$empDir.'/'.$name;
            $document->tableName="cable_client";
            $document->save();
        }
        }




        return back();
    }

    public function edit(Request $r){
        $client = CableClient::findOrFail($r->id);

        $documents=ClientFile::where('tableName','cable_client')
            ->where('clienId',$r->id)
            ->get();
        return view('cable-client.edit', compact('client','documents'));
    }

    public function update(Request $r , $id){
        $client = CableClient::findOrFail($id);
        $client->clientFirstName=$r->clientFirstName;
        $client->clientLastName=$r->clientLastName;
        $client->email=$r->email;
        $client->phone=$r->phone;
        $client->address=$r->address;
        $client->cableLength=$r->cableLength;
        $client->clientSerial=$r->clientSerial;
        $client->noOfTv=$r->noOfTv;
        $client->conDate=$r->conDate;
        $client->price=$r->price;

        $client->save();
        Session::flash('message', 'Client Updated Successfully!');


        $index=0;
        if($r->clientImage) {
            foreach ($r->file('clientImage') as $image) {
                $fileName = $r->clientFile[$index];
                $index++;

                $name = $fileName . time() . $image->getClientOriginalName();


                $empid = $client->clientId;
                $empDir = "documents" . '/cable_client';
                if (!file_exists(public_path($empDir))) {
                    mkdir(public_path($empDir), 0777, true);
                }


                $image->move(public_path($empDir), $name);
                $document = new ClientFile();
                $document->clienId = $empid;
                $document->name = $fileName;
                $document->uploadedBy = Auth::user()->userId;
                $document->path = $empDir . '/' . $name;
                $document->tableName = "cable_client";
                $document->save();
            }
        }

        return back();


    }

}
