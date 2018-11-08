<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function showEmployee(){
       $employee = Employee::all();
       return view('User.Employee.showEmployee')->with('employees',$employee);
    }
    public function createEmployee(){
        return view('User.Employee.createEmployee');
    }
    public function storeEmployee(Request $r){
        $emp = new Employee();
        $emp->employeeName = $r->employeeName;
        $emp->degisnation = $r->degisnation;
        $emp->salary = $r->salary;
        $emp->phone = $r->phone;
        $emp->email = $r->email;
        $emp->address = $r->address;
        $emp->status = '1';
        $emp->save();
        session()->flash('success', 'Employee Added Successfully');
        return redirect()->route('employee.show');
    }

    public function updateEmployee(Request $r){
        $emp = Employee::findOrfail($r->editid);
        $emp->employeeName=$r->employeeName;
        $emp->degisnation=$r->degisnation;
        $emp->salary=$r->salary;
        $emp->phone=$r->phone;
        $emp->email=$r->email;
        $emp->address=$r->address;
        $emp->status='1';
        $emp->update();
        session()->flash('success', 'Employee updated Successfully');
        return redirect()->route('employee.show');
    }

    public function deleteEmployee(Request $r)
    {
//        return $r;
        $emp = Employee::findOrFail($r->deleteId)->delete();
        return redirect()->route('employee.show');
    }


}
