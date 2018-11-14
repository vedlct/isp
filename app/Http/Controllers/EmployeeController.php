<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showEmployee(){
       return view('User.Employee.showEmployee');
    }
    public function getEmpData(Request $r){
        $employee = Employee::all();
        $datatables = DataTables::of($employee);
        return $datatables->make(true);
    }
    public function edit(Request $r){

        $employee=Employee::findOrFail($r->id);

        return view('User.Employee.editEmployee',compact('employee'));
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
//        return $r->empId;
        $employee = Employee::findOrFail($r->empId);
        $employee->employeeName=$r->employeeName;
        $employee->degisnation=$r->degisnation;
        $employee->salary=$r->salary;
        $employee->phone=$r->phone;
        $employee->email=$r->email;
        $employee->address=$r->address;
        $employee->status=$r->status;
        $employee->save();
        session()->flash('success', 'Employee updated Successfully');
        return redirect()->route('employee.show');
    }
public function getSalary(){
    $emp = Employee::get();
    $report = Report::where('tableName','=','employee')->get();

//        $getDate = Carbon::parse($emp)->format('m');
//        $monthget = Carbon::now()->format('m');

    return view('User.Employee.getSalary')->with('employees',$emp)->with('report',$report);
}
public function salaryStore(Request $r){
    $employee = Employee::all();
    $datatables = DataTables::of($employee);
    return $datatables->make(true);
}

public function salaryByMonth(Request $request){
        $currentMonth = Carbon::parse($request->chooseMonth)->format('m');
        $currentYear = Carbon::parse($request->chooseMonth)->format('Y');
        $emp = Employee::get();
        $report = Report::where(DB::raw('Year(date)'),$currentYear)->where(DB::raw('Month(date)'),$currentMonth)->get();
        return response()->json($report);
}



public function testEmployee(){

}

}
