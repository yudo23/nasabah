<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route("dashboard.index");
});

Route::group(['as' => 'dashboard.'], function () {
    Route::get('dashboard', 'DashboardController@index')->name("index");
    Route::resource('nasabah', 'NasabahController');
    Route::resource('transaction', 'TransactionController');
    Route::resource('point', 'PointController');
    Route::resource('report', 'ReportController');
});
