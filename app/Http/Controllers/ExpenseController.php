<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
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

//    public function filterByType(Request $request)
//    {
//        if($request->status) {
//            $expense = Expense::where('expenseType',$request->status)->get();
//            return response()->json(['data' => $expense]);
//        } else {
//            $expense = Expense::get();
//            return response()->json(['data' => $expense]);
//        }
//    }

}
