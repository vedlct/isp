<?php


Route::get('/', function () {
    return view('index');
})->middleware('auth')->name('index');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
/*
 * Employee Routes
 */
Route::get('/employee-show','EmployeeController@showEmployee')->name('employee.show');
Route::post('/edit','EmployeeController@edit')->name('employee.edit');
Route::post('/employee-store','EmployeeController@storeEmployee')->name('employee.store');
Route::post('/employee-update','EmployeeController@updateEmployee')->name('employee.updateEmployee');
Route::post('/employee-get-data','EmployeeController@getEmpData')->name('employee.getData');

/*
 * Employee Salary
 */
Route::get('/employee-salary','EmployeeController@getSalary')->name('employee.getSalary');
Route::post('/employee-salary','EmployeeController@salaryStore')->name('employee.salaryStore');

/*
 * Expense Route
 */
Route::post('/expense-getData','ExpenseController@getExpenseData')->name('expense.getData');
Route::get('/expense-show','ExpenseController@expenseShow')->name('expense.show');
Route::post('/expense-edit','ExpenseController@expenseEdit')->name('expense.edit');
Route::post('/expense-save','ExpenseController@storeExpense')->name('expense.store');
Route::post('/expense-update','ExpenseController@updateExpense')->name('expense.update');
Route::post('/expense-delete','ExpenseController@deleteExpense')->name('expense.deleteExpense');


/*
 * Client Routes
 */
Route::get('/Client','ClientController@show')->name('client.show');
Route::post('/Client-getData','ClientController@getData')->name('client.getdata');
Route::post('/Client-insert','ClientController@insert')->name('client.insert');
Route::post('/Client-edit','ClientController@edit')->name('client.edit');
Route::post('/Client-update/{id}','ClientController@update')->name('client.update');


/*
 * Package Routes
 */
Route::get('/Package','PackageController@show')->name('package.show');
Route::post('/Package-getData','PackageController@getData')->name('package.getdata');
Route::post('/Package-insert','PackageController@insert')->name('package.insert');
Route::post('/Package-edit','PackageController@edit')->name('package.edit');
Route::post('/Package-update/{id}','PackageController@update')->name('package.update');
Route::post('/Package-getpackage','PackageController@getpackage')->name('package.getpackage');


/*
 * Bill Routes
 */
Route::get('/Bill','BillController@show')->name('bill.show');
Route::post('/Bill-paid','BillController@paid')->name('bill.paid');
Route::post('/Bill-due','BillController@due')->name('bill.due');

 /* Report Routes
 */
Route::get('/Report-Debit','ReportController@showDebit')->name('report.showDebit');
Route::post('/Report-Debit','ReportController@getDebitData')->name('report.getDebitData');
Route::post('/Report-Debit-Sum','ReportController@getTotalDebitSum')->name('report.getTotalDebit');

//Route::post('/Package-insert','PackageController@insert')->name('package.insert');
//Route::post('/Package-edit','PackageController@edit')->name('package.edit');
//Route::post('/Package-update/{id}','PackageController@update')->name('package.update');
//Route::post('/Package-getpackage','PackageController@getpackage')->name('package.getpackage');


 /* Company Info
 */
Route::get('company-info','CompanyController@index')->name('company');
Route::post('company-info/{id}','CompanyController@edit')->name('company.edit');

/*
 * Bill Info
 */

Route::get('test','BillController@generatePdf');




//=====================Account=========================================
//
Route::get('settings/account','AccountController@index')->name('account.index');
Route::post('settings/account','AccountController@changePassword')->name('account.changePassword');

