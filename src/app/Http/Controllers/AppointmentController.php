<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AttendingProfessional;
use App\Models\Doctor;
use App\Rules\CPFRule;
use App\Utils\MakeAgenda;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::
        join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->join('attending_professionals', 'attending_professionals.id', '=', 'appointments.attending_professional_id')
        ->select('appointments.*', 'doctors.name AS doctor_name', 'attending_professionals.name AS attending_professional_name')
        ->get();
        $doctors = Doctor::all();
        return view('appointments.index', ['appointments' => $appointments, 'doctors' => $doctors]);
    }

    public function newAppointment(Request $request)
    {
        // Pega os atendimentos e junta com a tabela de médicos
        $doctor_appointments = Appointment::with(['doctor' => function ($query, $request) {
            $query->where('doctor_name', '=', $request->doctorName);
        }])->get();

        // Separa os horários já ocupados pelo médico
        $busyTimes = [];
        foreach($doctor_appointments as $appointment){
            array_push($busyTimes, $appointment->time);
        }

        // Filtra os horários disponíveis
        $appointmentTimes = MakeAgenda::createDay('09:00', '17:00', 30);
        $availableTimes = array_diff($appointmentTimes, $busyTimes);

        $doctors = Doctor::all();
        $attendingProfessionals = AttendingProfessional::all();

        return view('appointments.createAppointment', [
            'doctors' => $doctors,
            'availableTimes' => $availableTimes,
            'doctor_name' => $request->doctor_name,
            'date' => $request->date,
            'attending_professionals' => $attendingProfessionals,
        ]);
    }

    public function createAppointment(Request $request)
    {
        $data = $request->validate([
            'patient_name' => 'required',
            'patient_cpf' => ['required', new CPFRule()],
            'patient_sus_card' => 'required|digits:15',
            'reason' => 'nullable',
            'date' => 'required',
            'time' => 'required',
            'urgency' => 'required',
            'doctor_name' => 'required',
            'attending_professional' => 'required',
        ]);

        $data['attending_professional_id'] = AttendingProfessional::where('name', $request->attending_professional)->first()->id;
        $data['doctor_id'] = Doctor::where('name', $request->doctor_name)->first()->id;
        Appointment::create($data);

        return redirect(route('appointment.index'));
    }

    public function editAppointment(Appointment $appointment)
    {
        $doctors = Doctor::all();
        return view('appointments.editAppointment', ['appointment' => $appointment, 'doctors' => $doctors]);
    }

    public function updateAppointment(Appointment $appointment, Request $request)
    {
        $data = $request->validate([
            'patient_name' => 'required',
            'patient_cpf' => ['required', new CPFRule()],
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
