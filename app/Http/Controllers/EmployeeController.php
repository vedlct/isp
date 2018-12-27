<?php

namespace App\Http\Controllers;

use App\EmpFile;
use App\Employee;
use App\Report;
use App\Salary;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Auth;

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
        $user = User::findOrFail($employee->fkUserId);
        $documents=EmpFile::where('clienId',$r->id)
            ->get();

        return view('User.Employee.editEmployee',compact('employee','user','documents'));
    }

    public function storeEmployee(Request $r){

        $user = new User();
        $user->name = $r->employeeName;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->phone = $r->phone;
        $user->fkusertype = $r->usertype;
        $user->save();

        $emp = new Employee();
        $emp->employeeName = $r->employeeName;
        $emp->degisnation = $r->degisnation;
        $emp->salary = $r->salary;
        $emp->phone = $r->phone;
        $emp->email = $r->email;
        $emp->address = $r->address;
        $emp->status = '1';
        $emp->fkUserId = $user->userId;
        $emp->save();
        session()->flash('success', 'Employee Added Successfully');

        $index=0;
        if($r->clientImage) {
            foreach ($r->file('clientImage') as $image) {
                $fileName = $r->clientFile[$index];
                $index++;

                $name = $fileName . time() . $image->getClientOriginalName();


                $empid = $emp->employeeId;
                $empDir = "documents" . '/emp_files';
                if (!file_exists(public_path($empDir))) {
                    mkdir(public_path($empDir), 0777, true);
                }


                $image->move(public_path($empDir), $name);
                $document = new EmpFile();
                $document->clienId = $empid;
                $document->name = $fileName;
                $document->uploadedBy = Auth::user()->userId;
                $document->path = $empDir . '/' . $name;
                $document->save();
            }
        }
        return redirect()->route('employee.show');
    }

    public function updateEmployee(Request $r){
//        return $r->empId;
        $user = User::findOrFail($r->userId);
        $user->name = $r->employeeName;
        $user->email = $r->email;
        $user->phone = $r->phone;
        $user->fkusertype = $r->usertype;
        if($r->password!=null){
            $user->password = Hash::make($r->password);
        }
        $user->save();
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

        $index=0;
        if($r->clientImage) {
            foreach ($r->file('clientImage') as $image) {
                $fileName = $r->clientFile[$index];
                $index++;

                $name = $fileName . time() . $image->getClientOriginalName();


                $empid = $employee->employeeId;
                $empDir = "documents" . '/emp_files';
                if (!file_exists(public_path($empDir))) {
                    mkdir(public_path($empDir), 0777, true);
                }


                $image->move(public_path($empDir), $name);
                $document = new EmpFile();
                $document->clienId = $empid;
                $document->name = $fileName;
                $document->uploadedBy = Auth::user()->userId;
                $document->path = $empDir . '/' . $name;
                $document->save();
            }
        }


        return redirect()->route('employee.show');
    }
    public function getSalary(){
    //    $emp = Employee::get();
    //    $salary= Salary::get();
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');
        $salary =  DB::table('employee')->join('salary','salary.fkemployeeId','=','employee.employeeId')
            ->where(DB::raw('Year(date)'),$currentYear)->where(DB::raw('Month(date)'),$currentMonth)->get();

    //        $getDate = Carbon::parse($emp)->format('m');
    //        $monthget = Carbon::now()->format('m');

        return view('User.Employee.getSalary')->with('salary',$salary);
    }
    public function salaryStore(Request $r){
        $employee = Employee::all();
        $datatables = DataTables::of($employee);
        return $datatables->make(true);
    }

    public function salaryByMonth(Request $request){

            $currentMonth = Carbon::parse($request->chooseMonth)->format('m');
            $currentYear = Carbon::parse($request->chooseMonth)->format('Y');
            $salary = DB::table('employee')->join('salary','salary.fkemployeeId','=','employee.employeeId')
                ->where(DB::raw('Year(date)'),$currentYear)->where(DB::raw('Month(date)'),$currentMonth)->get();

            return view('User.Employee.getSalaryByFilter',compact('salary','currentMonth'));
    //        return response()->json($report);
    }

    public function paySalary(Request $r){
    //        return $r;
        $emp = Employee::findOrFail($r->id);
        $report = new Report();
        $report->status = 'debit';
        $report->price = $emp->salary;
        $report->date = Carbon::now()->format('Y-m-d');
        $report->tabelId=$emp->employeeId;
        $report->tableName= "employee";
        $report->save();
        $salary = Salary::where('fkemployeeId',$r->id)->where(DB::raw('month(date)'),$r->date)->first();
        $salary->status = 'paid';
        $salary->update();
        return back();
    }
    public function unPaySalary(Request $r){
//        return $r;
            $salary = Salary::findOrFail($r->id);
            $salary->status = 'np';
            $salary->update();

            return $salary;
        }

    public static function salaryStatus($id,$date){
//        return $id;
            $salary = Salary::where('fkemployeeId',$id)->where(DB::raw('month(date)'),$date)->first()->status;
            return $salary;
    }

    public function testEmployee(){

    }


    public function deleteFile(Request $r){
        $clientFile=EmpFile::findOrFail($r->id);
        $clientId=$clientFile->clienId;
        $clientFile->delete();
        return $clientId;
    }

}
