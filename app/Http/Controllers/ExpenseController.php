<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpensePerson;
use App\PersonalExpense;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function expenseShow(){
        return view('expense.showExpense');
    }
    public function getExpenseData(Request $r){
        $expense = Expense::all();
        if ($r->statusFilter){
            $expense=$expense->where('expenseType',$r->statusFilter);
        }

        $datatables = DataTables::of($expense);
        return $datatables->make(true);
    }
public function expenseEdit(Request $r){
        $expense = Expense::findOrFail($r->id);
        return view('expense.editExpense',compact('expense'));
}
    public function storeExpense(Request $r){
        $expense = new Expense();
        $expense->amount=$r->amount;
        $expense->price=$r->price;
        $expense->cause=$r->cause;
        $expense->expenseType = $r->expenseType;
        $expense->expenseFor = $r->expensefor;
        $expense->save();
        $report = new Report();
        $report->tabelId = $expense->expenseId;
        $report->price = $expense->price*$expense->amount;
        $report->status = 'debit';
        $report->date = Carbon::now()->format("Y-m-d");
        $report->tableName = 'expense';
        $report->save();

        session()->flash('success', 'Expense Added Successfully');
        return back();
    }

    public function updateExpense(Request $r){
        $expense = Expense::findOrFail($r->expenseId);
        $expense->amount=$r->amount;
        $expense->expenseType = $r->expenseType;
        $expense->expenseFor = $r->expensefor;
        $expense->price=$r->price;
        $expense->cause=$r->cause;
        $expense->save();
        session()->flash('success', 'Expense Updated Successfully');
       return  back();
    }


    public function deleteExpense(Request $r){
        $expense = Expense::findOrFail($r->expenseId)->delete();
        $report = Report::where('tabelId',$r->expenseId)->delete();
        session()->flash('success', 'Expense Deleted Successfully');
        return back();
    }


    public function personalExpenseShow(){
        $expensePerson=ExpensePerson::get();

        return view('expense.personalExpense',compact('expensePerson'));
    }

    public function personalExpenseStore(Request $r){
//        return $r;
        $personalExpense=new PersonalExpense();
        $personalExpense->price=$r->price;
        $personalExpense->cause=$r->cause;
        $personalExpense->personId=$r->expensefor;
        $personalExpense->date=date('Y-m-d');
        $personalExpense->save();
        session()->flash('success', 'Expense added successfully');
        return back();

    }

    public function getPersonalExpenseData(Request $r){
        $expense = PersonalExpense::select('personal_expense.*','expense_person.name')
            ->leftJoin('expense_person','expense_person.id','personal_expense.personId');
        if($r->fromdate && $r->toDate){
            $expense=$expense->whereBetween('personal_expense.date',[$r->fromdate,$r->toDate]);
        }
        $datatables = DataTables::of($expense->get());
        return $datatables->make(true);

    }

    public function editPersonalExpenseData(Request $r){
        $expense=PersonalExpense::findOrFail($r->id);
        $expensePerson=ExpensePerson::get();
        return view('expense.editPersonalExpense',compact('expense','expensePerson'));
    }

    public function updatePersonalExpenseData($id,Request $r){

        $personalExpense=PersonalExpense::findOrFail($r->id);
        $personalExpense->price=$r->price;
        $personalExpense->cause=$r->cause;
        $personalExpense->personId=$r->expensefor;
        $personalExpense->date=$r->date;
        $personalExpense->save();
        session()->flash('success', 'Expense updated successfully');
        return back();

    }

    public function deletePersonalExpenseData(Request $r){
        PersonalExpense::destroy($r->id);
    }

}
