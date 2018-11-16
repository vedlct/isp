<?php


Route::get('/','DashBoardController@index')->middleware('auth')->name('index');
Route::get('/previousdue','DashBoardController@previousdue')->name('dashboard.duepayment');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
/*
 * Employee Routes
 */
Route::get('/employee-show','EmployeeController@showEmployee')->name('employee.show');
Route::post('/employee-show','EmployeeController@getEmpData')->name('employee.getData');
Route::post('/edit','EmployeeController@edit')->name('employee.edit');
Route::post('/employee-store','EmployeeController@storeEmployee')->name('employee.store');
Route::post('/employee-update','EmployeeController@updateEmployee')->name('employee.updateEmployee');
Route::post('/employee-salary-month','EmployeeController@salaryByMonth')->name('employee.salaryByMonth');
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
Route::post('/expense/filterByType', 'ExpenseController@filterByType')->name('expense.filterByType');


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

* Report Routes
=======
 * Bill Routes
 */
Route::get('/Bill','BillController@show')->name('bill.show');
Route::get('/Bill-PastDue-Client','BillController@showPastDue')->name('bill.showPastDue');
Route::get('/Bill/{date}','BillController@showDate')->name('bill.show.date');
Route::post('/Bill-paid','BillController@paid')->name('bill.paid');
Route::post('/Bill-due','BillController@due')->name('bill.due');

 /* Report Routes

 */
Route::get('/Report-Debit','ReportController@showDebit')->name('report.showDebit');
Route::post('/Report-Debit','ReportController@getDebitData')->name('report.getDebitData');
Route::post('/Report-Debit-Sum','ReportController@getTotalDebitSum')->name('report.getTotalDebit');


Route::get('/Report-Credit','ReportController@showCredit')->name('report.showCredit');

Route::post('/Report-Credit','ReportController@getCreditData')->name('report.getCreditData');
Route::post('/Report-Credit-Sum','ReportController@getTotalCreditSum')->name('report.getTotalCredit');
Route::post('/Report-Details','ReportController@showDetailsReport')->name('report.Details');

Route::get('/Report-Summary','ReportController@showSummary')->name('report.showSummary');

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


Route::get('bill/generate/{id}/{date}','BillController@generatePdf')->name('bill.invoice');
Route::get('settings/account','AccountController@index')->name('account.index');
Route::post('settings/account','AccountController@changePassword')->name('account.changePassword');


