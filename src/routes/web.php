<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [AppointmentController::class, 'index'])->name('appointment.index');
Route::post('/', [AppointmentController::class, 'makeAppointment'])->name('appointment.makeAppointment');
Route::put('/', [AppointmentController::class, 'editAppointment'])->name('appointment.editAppointment');
Route::delete('/', [AppointmentController::class, 'deleteAppointment'])->name('appointment.deleteAppointment');