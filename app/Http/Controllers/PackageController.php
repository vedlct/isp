<?php

namespace App\Http\Controllers;

use App\CablePackage;
use App\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;


class PackageController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){

        return view('package.show');
    }
    public function insert(Request $r){
        $package = new Package();
        $package->packageName=$r->packageName;
        $package->bandwidth=$r->bandwidth;
        $package->price=$r->price;
        $package->save();
        Session::flash('message', 'Package Insert Successfully!');
        return back();
    }
    public function edit(Request $r){

        $package=Package::findOrFail($r->id);

        return view('package.edit',compact('package'));
    }

    public function update(Request $r, $id){
        $package = Package::findOrFail($id);
        $package->packageName=$r->packageName;
        $package->bandwidth=$r->bandwidth;
        $package->price=$r->price;
        $package->save();
        Session::flash('message', 'Package Updated Successfully!');
        return back();

    }

    public function getData(Request $r){
        $package = Package::get();
        $datatables = Datatables::of($package);
        return $datatables->make(true);
    }

    public function getpackage(Request $r ){
        $package = Package::select('bandwidth', 'price')
        ->where('packageId' , $r->id)
        ->first();
        return $package;
    }

////////////////cable/////////////////////

    public function cableshow(){

        return view('package.cableshow');
    }
    public function cableinsert(Request $r){
        $package = new CablePackage();
        $package->cablepackageName=$r->cablepackageName;
        $package->price=$r->price;
        $package->save();
        Session::flash('message', 'cable Package Insert Successfully!');
        return back();
    }
    public function cableedit(Request $r){

        $package=CablePackage::findOrFail($r->id);

        return view('package.cableedit',compact('package'));
    }

    public function cableupdate(Request $r, $id){
        $package = CablePackage::findOrFail($id);
        $package->cablepackageName=$r->cablepackageName;
        $package->price=$r->price;
        $package->save();
        Session::flash('message', 'Cable Package Updated Successfully!');
        return back();

    }

    public function cablegetData(Request $r){
        $package = CablePackage::get();
        $datatables = Datatables::of($package);
        return $datatables->make(true);
    }

    public function cablegetpackage(Request $r ){
        $package = CablePackage::select( 'price')
            ->where('cablepackageId' , $r->id)
            ->first();
        return $package;
    }
}
