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

Route::get('/new', [AppointmentController::class, 'newAppointment'])->name('appointment.newAppointment');
Route::post('/create', [AppointmentController::class, 'createAppointment'])->name('appointment.createAppointment');
Route::get('/edit/{appointment}', [AppointmentController::class, 'editAppointment'])->name('appointment.editAppointment');
Route::put('/update/{appointment}', [AppointmentController::class, 'updateAppointment'])->name('appointment.updateAppointment');
Route::delete('/delete/{appointment}', [AppointmentController::class, 'deleteAppointment'])->name('appointment.deleteAppointment');
Route::get('/', [AppointmentController::class, 'index'])->name('appointment.index');