<?php
use APP\Http\Controllers\BankController;

Route::get('payments/{id}', 'App\Http\Controllers\BankController@show');
Route::get('payments', 'App\Http\Controllers\BankController@index');
Route::post('payments/create', 'App\Http\Controllers\BankController@store');