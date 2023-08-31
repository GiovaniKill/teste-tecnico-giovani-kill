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
        <h2>📋 Novo atendimento</h2>
        <form action="{{route('appointment.newAppointment')}}" method="get">
            <label>
                Nome do médico:
                <select id="doctor_name" name="doctor_name" required>
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->name}}">{{$doctor -> name}}</option>
                    @endforeach
                </select>
            </label>
            <label>
                Data:
                <!-- A data máxima é gerada a partir de um mês de agora
                usando a função mktime e convertendo para o formato certo 
                com a função date-->
                <input 
                    type="date"
                    name="date"
                    min="{{date('Y-m-d')}}"
                    max="{{date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 30, date('Y')))}}"
                    required/>
            </label>
            <input type="submit" name="submit" value="Consultar disponibilidade">
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
                    <th>Data do atendimento</th>
                    <th>Horário do atendimento</th>
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
                        <td>{{$appointment->reason}}</td>
                        <td>{{$appointment->date}}</td>
                        <td>{{$appointment->time}}</td>
                        <td>{{$appointment->urgency}}</td>
                        <td>{{$appointment->doctor_name}}</td>
                        <td>{{$appointment->attending_professional_name}}</td>
                    </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>