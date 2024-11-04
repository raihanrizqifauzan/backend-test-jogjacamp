<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\DiagnoseController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

Route::post('/patient', [PatientController::class, 'store']);
Route::post('/diagnose', [DiagnoseController::class, 'store']);
Route::post('/service', [ServiceController::class, 'store']);

Route::post('/appointment', [AppointmentController::class, 'store']);
Route::get('/appointment/{id}', [AppointmentController::class, 'show']);
Route::patch('/appointment/{id}', [AppointmentController::class, 'update']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
