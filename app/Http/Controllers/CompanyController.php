<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;
class CompanyController extends Controller
{
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
}
