<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Rules\CPFRule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return view('appointments.index');
    }

    public function makeAppointment(Request $request){
        $appointment = $request->validate([
            'patient_name' => 'required',
            'patient_cpf' => ['required', new CPFRule],
            'patient_sus_card' => 'required|digits:15',
            'appointment_urgency' => 'required',
            'appointment_reason' => 'nullable',
            'doctor_name' => 'required',
            'attending_professional' => 'required',
        ]);

        Appointment::create($appointment);

        return redirect(route('appointment.index'));
    }
}
