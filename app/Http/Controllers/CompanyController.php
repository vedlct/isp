<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;
use App\ExpensePerson;
class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $company=Company::first();
        return view('company',compact('company'));
    }

    public function edit($id,Request $r)
    {
       $company=Company::findOrFail($id);
        $company->companyTitle=$r->companyTitle;
        $company->companyEmail=$r->companyEmail;
        $company->companyPhone1=$r->companyPhone1;
        $company->companyPhone2=$r->companyPhone2;
        $company->companyAddress=$r->companyAddress;
        $company->save();

        return back();
    }

    public function expense_person(){
        $person = ExpensePerson::get();
        return view('expense_person',compact('person'));
    }

    public function expense_person_insert(Request $r){
        $person = new ExpensePerson();
        $person->name = $r->name;
        $person->save();

        Session::flash('message', 'New Person Added!');
        return back();
    }

    public function editPerson(Request $r){
        $person = ExpensePerson::where('id', $r->id)->first();
        return view('edit_expense_person',compact('person'));
    }

    public function updatePerson(Request $r){
        $person = ExpensePerson::findOrFail($r->id);
        $person->name = $r->name;
        $person->save();

        Session::flash('message', 'Person Updated!');
        return back();

    }
}
