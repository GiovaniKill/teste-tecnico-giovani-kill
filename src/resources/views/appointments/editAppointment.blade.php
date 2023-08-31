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
        <h2>Mudar horário ou médico</h2>
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
        @if($errors->any())
        Por favor, corrija os seguintes erros para alterar o atendimento:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{route('appointment.editAppointment')}}" method="put">
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
            <input type="date" id="date" name="date" value="{{$appointment-> date}}" disabled>
        </label>
        <label>
            Horário do atendimento:
            <select type="text" id="time" name="time" value="{{$appointment-> time}}">
                @foreach($appointment -> time as $time)
                    <option value="{{$time}}">{{$time}}</option>
                @endforeach
            </select>   
        </label>
        <label>
            Urgência do atendimento:
            <select id="urgency" name="urgency" value="{{$appointment-> urgency}}" required>
                <option value="low">Baixa</option>
                <option value="medium" selected>Média</option>
                <option value="high">Alta</option>
                <option value="urgent">Urgente</option>
            </select>
        </label>
        <label>
            Nome do médico:
            <input type="text" id="doctor_name" name="doctor_name" value="{{$appointment-> doctor_id}}" required>
        </label>
        <label>
            Profissional atendente:
            <input type="text" id="attending_professional" name="attending_professional" value="{{$appointment-> attending_professional_id}}" required>
        </label>
        <input type="submit" name="Marcar atendimento"/>
    </form>
</body>
</html>