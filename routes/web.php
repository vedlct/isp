<?php


Route::get('/','DashBoardController@index')->middleware('auth')->name('index');
Route::get('/previousdue','DashBoardController@previousdue')->name('dashboard.duepayment');
Route::get('/insertbillformonth','DashBoardController@insertbillformonth')->name('dashboard.insertbillformonth');

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
Route::post('/employee-salary-pay','EmployeeController@paySalary')->name('employee.salary.pay');
Route::post('/employee-salary-unpay','EmployeeController@unPaySalary')->name('employee.unPaySalary');
Route::post('employee/deleteFile','EmployeeController@deleteFile')->name('employee.deleteFile');



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
 * Internet Client
 */


Route::get('internet/client','InternetClientController@index')->name('internet.client.index');
Route::post('internet/client','InternetClientController@getData')->name('internet.client.getData');
Route::post('internet/client/insert','InternetClientController@insert')->name('internet.client.insert');
Route::post('internet/client/edit','InternetClientController@edit')->name('internet.client.edit');
Route::post('internet/Client-update/{id}','InternetClientController@update')->name('internet.client.update');
Route::post('internet/client/deleteFile','InternetClientController@deleteFile')->name('internet.client.deleteFile');

/*
 * Cable Client
 */

Route::get('cable/client','CableClientController@index')->name('cable.client.index');
Route::post('cable/client','CableClientController@getData')->name('cable.client.getData');
Route::post('cable/client/insert','CableClientController@insert')->name('cable.client.insert');
Route::post('cable/client/edit','CableClientController@edit')->name('cable.client.edit');
Route::post('cable/Client-update/{id}','CableClientController@update')->name('cable.client.update');



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

Route::get('/Package-cable','PackageController@cableshow')->name('package.cable.show');
Route::post('/Package-cable-getData','PackageController@cablegetData')->name('package.cable.getdata');
Route::post('/Package-cable-insert','PackageController@cableinsert')->name('package.cable.insert');
Route::post('/Package-cable-edit','PackageController@cableedit')->name('package.cable.edit');
Route::post('/Package-cable-update/{id}','PackageController@cableupdate')->name('package.cable.update');
Route::post('/Package-cable-getpackage','PackageController@cablegetpackage')->name('package.cable.getpackage');


/*

* Report Routes
=======
 * Bill Routes
 */

Route::get('/Bill','BillController@show')->name('bill.show');
Route::post('/Bill','BillController@showWithData')->name('bill.show.withData');

Route::get('/Bill-PastDue-Client','BillController@showPastDue')->name('bill.showPastDue');

Route::get('/Bill-PastDueLastMonth-Client','BillController@showPastDueLastMonth')->name('bill.showPastDueLastMonth');
Route::get('/Bill/{date}','BillController@showDate')->name('bill.show.date');

Route::post('/Bill-paid','BillController@paid')->name('bill.paid');
Route::post('/Bill-due','BillController@due')->name('bill.due');

/*internet */

Route::get('/Internet-Bill-Recieved','BillController@internetBillRecieved')->name('bill.internet.showTotalBillRecieved');


Route::get('/Internet-Bill','BillController@internetBillShow')->name('bill.Internet.show');

Route::post('/Internet-Bill','BillController@internetBillShowWithData')->name('bill.internet.show.withData');

Route::get('/Bill/{date}','BillController@showInternetBillDate')->name('bill.Internet.show.date');
Route::post('/Internet-Bill-paid','BillController@internetBillPaid')->name('bill.Internet.paid');

Route::get('/Bill-PastDue-Internet-Client','BillController@showPastDue')->name('bill.Internet.showPastDue');


Route::post('/Internet-Bill-due','BillController@internetBillDue')->name('bill.Internet.due');
Route::post('/Internet-Bill-approved','BillController@approvedInternet')->name('bill.internet.approved');


/*Cable*/
Route::get('/Cable-Bill-Recieved','BillController@cableBillRecieved')->name('bill.cable.showTotalBillRecieved');

Route::get('/Cable-Bill','BillController@cableBillShow')->name('bill.Cable.show');
Route::post('/Cable-Bill','BillController@cableBillShowWithData')->name('bill.cable.show.withData');
Route::post('/Cable-Bill-paid','BillController@cableBillPaid')->name('bill.Cable.paid');
Route::post('/Cable-Bill-due','BillController@cableBillDue')->name('bill.Cable.due');
Route::post('/Cable-Bill-approved','BillController@approvedCable')->name('bill.Cable.approved');

Route::get('Bill/Generate-Cable/{id}/{date}','BillController@generateCablePdf')->name('bill.Cable.invoiceByClient');

Route::get('Bill/Generate-Cable-All/{date}','BillController@generateAllCableBillPdf')->name('bill.Cable.invoice');

Route::get('/Bill-PastDue-Cable-Client','BillController@showCablePastDue')->name('bill.Cable.showPastDue');

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



Route::get('Bill/generate/{id}/{date}','BillController@generateInternetPdf')->name('bill.Internet.invoiceByClient');
//Route::get('bill/generate/{id}/{date}','BillController@generatePdf')->name('bill.invoice');

Route::get('Bill/Generate-All/{date}','BillController@generateAllInternetBillPdf')->name('bill.Internet.invoice');


Route::get('settings/account','AccountController@index')->name('account.index');

Route::post('settings/account','AccountController@changePassword')->name('account.changePassword');


//Route::get('status/{id}','EmployeeController@salaryStatus');

/*Sms*/

Route::get('SMS-sendBillToPay','SmsController@sendBillToPay')->name('sms.billToPay.send');
Route::get('SMS-sendBillSms','SmsController@sendBillSms')->name('sms.sendBillSms.send');
Route::get('SMS-sendCableBillSms','SmsController@sendCableBillSms')->name('sms.sendCableBillSms.send');
Route::get('SMS-sendCableBillToPay','SmsController@sendCableBillToPay')->name('sms.cablebillToPay.send');
Route::get('SMS-Config','SmsController@config')->name('sms.config');
Route::post('SMS-Add-Config','SmsController@addNewconfig')->name('sms.addConfig');
Route::post('SMS-Edit-Config','SmsController@editconfig')->name('sms.editSmsConfig');
Route::post('SMS-Update-Config','SmsController@updateconfig')->name('sms.updateConfig');



