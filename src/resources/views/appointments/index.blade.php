<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de atendimentos</title>
</head>
<body>
    <h1>Lista de atendimentos</h1>

    <div>
        <form action="{{route('appointment.newAppointment')}}" method="get">
            <label>
                Nome do médico:
                <select id="appointment_urgency" name="appointment_urgency" required>
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor -> name}}">{{$doctor -> name}}</option>
                    @endforeach
                </select>
            </label>
            <label>
                Data:
                <input type="date" name="date" placeholder="dd-mm-yyyy" required/>
            </label>
            <input type="submit" name="submit" value="📋 Novo atendimento">
        </form>
    </div>

    <div>
        <table border='1'>
            <thead>
                <tr>
                    <th>Excluir</th>
                    <th>Editar</th>
                    <th>Nome do paciente</th>
                    <th>CPF do paciente</th>
                    <th>Cartão SUS do paciente</th>
                    <th>Motivo do atendimento</th>
                    <th>Urgência do atendimento</th>
                    <th>Médico atendente</th>
                    <th>Profissional que realizou o atendimento</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)

                    <tr>
                        <td>
                            <a href="">
                                <button>❌</button>
                            </a>
                        </td>
                        <td>
                            <a href="{{route('appointment.editAppointment', ['appointment' => $appointment])}}">
                                <button>✍️</button>
                            </a>
                        </td>
                        <td>{{$appointment->patient_name}}</td>
                        <td>{{$appointment->patient_cpf}}</td>
                        <td>{{$appointment->patient_sus_card}}</td>
                        <td>{{$appointment->appointment_reason}}</td>
                        <td>{{$appointment->appointment_urgency}}</td>
                        <td>{{$appointment->doctor_name}}</td>
                        <td>{{$appointment->attending_professional}}</td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>