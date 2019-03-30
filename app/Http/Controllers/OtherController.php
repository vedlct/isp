<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Other;
use Yajra\DataTables\DataTables;

class OtherController extends Controller
{
    public function index(){
        return view('other.index');
    }

    public function getData(Request $r){
        $other = Other::select('other.*');
        $datatables = Datatables::of($other);
        return $datatables->make(true);
    }

    public function create(){
        return view('other.create');
    }

    public function insert(Request $r){
        $other = new Other();
        $other->title = $r->title;
        $other->description = $r->desc;
        $other->amount = $r->amount;
        $other->type = $r->type;
        $other->save();

        Session::flash('message', 'Other Data Insert Successfully!');
        return back();
    }

    public function edit(Request $r){
        $other = Other::findOrFail($r->id);
        return view('other.edit')->with('other', $other);
    }

    public function update(Request $r){
        $other = Other::findOrfail($r->id);
        $other->title = $r->title;
        $other->description = $r->desc;
        $other->amount = $r->amount;
        $other->type = $r->type;
        $other->save();

        Session::flash('message', 'Other Data Updated Successfully!');
        return back();
    }

    public function delete(Request $r){
        $other = Other::findOrFail($r->id);
        $other->delete();

        return back();
    }
}
