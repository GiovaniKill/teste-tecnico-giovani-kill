<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Rules\CPFRule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
        return view('appointments.index', ['appointments' => $appointments]);
    }

    public function newAppointment(){
        return view('appointments.createAppointment');
    }

    public function createAppointment(Request $request){
        $data = $request->validate([
            'patient_name' => 'required',
            'patient_cpf' => ['required', new CPFRule],
            'patient_sus_card' => 'required|digits:15',
            'appointment_urgency' => 'required',
            'appointment_reason' => 'nullable',
            'doctor_name' => 'required',
            'attending_professional' => 'required',
        ]);

        Appointment::create($data);

        return redirect(route('appointment.index'));
    }

    public function editAppointment(Appointment $appointment){
        return view('appointments.editAppointment', ['appointment' => $appointment]);
    }

    public function updateAppointment(Appointment $appointment, Request $request){
        $data = $request->validate([
            'patient_name' => 'required',
            'patient_cpf' => ['required', new CPFRule],
            'patient_sus_card' => 'required|digits:15',
            'appointment_urgency' => 'required',
            'appointment_reason' => 'nullable',
            'doctor_name' => 'required',
            'attending_professional' => 'required',
        ]);

        $appointment->update($data);

        return redirect(route('appointment.index'))->with('success', 'Atendimento atualizado!');
    }
}
