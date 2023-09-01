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
        ->select(
            'appointments.*',
            'doctors.name AS doctor_name',
            'attending_professionals.name AS attending_professional_name'
        )
        ->orderBy('date', 'asc')
        ->get();
        $doctors = Doctor::all();
        return view('appointments.index', ['appointments' => $appointments, 'doctors' => $doctors]);
    }

    public function newAppointment(Request $request)
    {
        // Pega os atendimentos e junta com a tabela de médicos
        $doctor_appointments = Appointment::
        join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->where('name', '=', $request->doctor_name)
        ->where('date', '=', $request->date)
        ->get();

        // Separa os horários já ocupados pelo médico
        $busyTimes = [];
        foreach ($doctor_appointments as $appointment) {
            array_push($busyTimes, $appointment->time);
        }

        // Filtra os horários disponíveis
        $appointmentTimes = MakeAgenda::createDay('09:00', '17:00', 30);
        $availableTimes = array_diff($appointmentTimes, $busyTimes);

        $doctors = Doctor::all();
        $attendingProfessionals = AttendingProfessional::all();

        return view('appointments.newAppointment', [
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

        $data['attending_professional_id'] = AttendingProfessional::
        where('name', $request->attending_professional)
        ->first()->id;
        $data['doctor_id'] = Doctor::where('name', $request->doctor_name)->first()->id;
        Appointment::create($data);

        return redirect(route('appointment.index'));
    }

    public function editAppointment(Appointment $appointment, Request $request)
    {
        //Verifica se a request veio de dentro da página de editar, para alterar os campos
        //com os novos valores ou procurar no banco pelo nome do médico
        if ($request->submit == 'Consultar disponibilidade') {
            $doctor = $request->doctor_name;
            $appointment['date'] = $request->date;
        } else {
            $doctor = Doctor::where('id', '=', $appointment->doctor_id)->first()->name;
        }

        //Pega os atendimentos e junta com a tabela de médicos
        $doctor_appointments = Appointment::
        join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
        ->where('name', '=', $request->doctor_name)
        ->where('date', '=', $request->date)
        ->get();

        //Separa os horários já ocupados pelo médico
        $busyTimes = [];
        foreach ($doctor_appointments as $doctorAppointment) {
            array_push($busyTimes, $doctorAppointment->time);
        }

        //Filtra os horários disponíveis
        $appointmentTimes = MakeAgenda::createDay('09:00', '17:00', 30);
        $availableTimes = array_diff($appointmentTimes, $busyTimes);

        //Consulta no banco os nomes para disponibilizar na procura
        $doctors = Doctor::all();
        $attendingProfessionals = AttendingProfessional::all();

        //Consulta o banco para trocar o id pelo nome do atendente
        $attendingProfessional = AttendingProfessional::
        where('id', '=', $appointment->attending_professional_id)
        ->first()->name;

        return view('appointments.editAppointment', [
            'doctors' => $doctors,
            'availableTimes' => $availableTimes,
            'doctor_name' => $doctor,
            'date' => $request->date,
            'attending_professionals' => $attendingProfessionals,
            'attending_professional_name' => $attendingProfessional,
            'appointment' => $appointment,
        ]);
    }

    public function updateAppointment(Appointment $appointment, Request $request)
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

        $data['attending_professional_id'] = AttendingProfessional::
        where('name', $request->attending_professional)
        ->first()->id;
        $data['doctor_id'] = Doctor::where('name', $request->doctor_name)->first()->id;
        $appointment->update($data);

        return redirect(route('appointment.index'))->with('success', 'Atendimento atualizado!');
    }

    public function deleteAppointment(Appointment $appointment)
    {
        $appointment->delete();

        return redirect(route('appointment.index'))->with('success', 'Atendimento excluído!');
    }
}
