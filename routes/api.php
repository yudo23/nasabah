<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'as' => 'api.',"middleware" => ['json.response']], function () {
    Route::apiResource('nasabah', 'NasabahController');
    Route::apiResource('transaction', 'TransactionController');
    Route::apiResource('point', 'PointController')->only(['index']);
    Route::apiResource('report', 'ReportController')->only(['index']);
});
