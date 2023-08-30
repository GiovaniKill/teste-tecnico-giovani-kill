<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Rules\CPFRule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        $appointments = Appointment::all();
        $doctors = Doctor::all();
        return view('appointments.index', ['appointments' => $appointments, 'doctors' => $doctors]);
    }

    public function newAppointment(Request $request){
        $doctor_appointments = Doctor::where('name', $request->doctor_name)->get();
        dd($doctor_appointments);
        //return view('appointments.createAppointment');
    }

    public function createAppointment(Request $request){
        dd($request);
        // $data = $request->validate([
        //     'patient_name' => 'required',
        //     'patient_cpf' => ['required', new CPFRule],
        //     'patient_sus_card' => 'required|digits:15',
        //     'appointment_urgency' => 'required',
        //     'appointment_reason' => 'nullable',
        //     'doctor_name' => 'required',
        //     'attending_professional' => 'required',
        // ]);

        // Appointment::create($data);

        // return redirect(route('appointment.index'));
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
