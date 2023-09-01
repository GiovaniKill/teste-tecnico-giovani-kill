<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar atendimento</title>
</head>
<body>
    <h1>Editar atendimento</h1>

    <div>
        <h2>Mudar horário e/ou médico</h2>
        <form action="{{route('appointment.editAppointment', ['appointment' => $appointment])}}" method="get">
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
        @if($errors->any())
        Por favor, corrija os seguintes erros para alterar o atendimento:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{route('appointment.updateAppointment', ['appointment' => $appointment])}}" method="post">
        @csrf
        @method('put')
        <label>
            Nome:
            <input type="text" id="patient_name" name="patient_name" value="{{$appointment-> patient_name}}" required>
        </label>
        <label>
            CPF:
            <input type="number" id="patient_cpf" name="patient_cpf" maxlength="14" value="{{$appointment-> patient_cpf}}" required>
        </label>
        <label>
            Cartão SUS:
            <input type="number" id="patient_sus_card" name="patient_sus_card" value="{{$appointment-> patient_sus_card}}" required>
        </label>
        <label>
            Motivo do atendimento:
            <input type="text" id="reason" name="reason" value="{{$appointment-> reason}}">
        </label>
        <label>
            Data do atendimento:
            <input type="date" value="{{$appointment->date}}" disabled>
            <input type="hidden" id="date" name="date" value="{{$appointment->date}}">
        </label>
        <label>
            Horário do atendimento:
            <select type="text" id="time" name="time" required>
                @foreach($availableTimes as $time)
                    <option value="{{$time}}" <?php if ($appointment->time === $time) echo 'selected'; ?>>{{$time}}</option>
                @endforeach
            </select>   
        </label>
        <label>
            Urgência do atendimento:
            <select id="urgency" name="urgency" required>
                <option value="Baixa" <?php if ($appointment->urgency === "Baixa") echo 'selected'; ?>>Baixa</option>
                <option value="Média" <?php if ($appointment->urgency === "Média") echo 'selected'; ?>>Média</option>
                <option value="Alta" <?php if ($appointment->urgency === "Alta") echo 'selected'; ?>>Alta</option>
                <option value="Urgente" <?php if ($appointment->urgency === "Urgente") echo 'selected'; ?>>Urgente</option>
            </select>
        </label>
        <label>
            Nome do médico:
            <input type="text" value="{{$doctor_name}}" disabled>
            <input type="hidden" id="doctor_name" name="doctor_name" value="{{$doctor_name}}">
        </label>
        <label>
            Profissional atendente:
            <select id="attending_professional" name="attending_professional" required>
                @foreach($attending_professionals as $attending_professional)
                    <option
                        value="{{$attending_professional -> name}}"
                        <?php if ($attending_professional->name === $attending_professional_name) echo 'selected'; ?>>
                        {{$attending_professional->name}}
                    </option>
                @endforeach
            </select>        
        </label>
        <input type="submit" name="Atualizar atendimento"/>
    </form>
</body>
</html>