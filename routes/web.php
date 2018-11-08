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
Route::get('/employee-create','EmployeeController@createEmployee')->name('employee.create');
Route::post('/employee-store','EmployeeController@storeEmployee')->name('employee.store');
Route::post('/employee-delete','EmployeeController@deleteEmployee')->name('employee.deleteEmployee');
Route::post('/employee-update','EmployeeController@updateEmployee')->name('employee.updateEmployee');

/*
 * Client Routes
 */
Route::get('/Client','ClientController@show')->name('client.show');
Route::post('/Client-getData','ClientController@getData')->name('client.getdata');
Route::get('/Client-edit','ClientController@edit')->name('client.edit');
