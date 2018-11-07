<?php


Route::get('/', function () {
    return view('index');
})->middleware('auth');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

