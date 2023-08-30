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
            <input type="text" id="appointment_reason" name="appointment_reason" value="{{$appointment-> appointment_reason}}">
        </label>
        <label>
            Urgência do atendimento:
            <select id="appointment_urgency" name="appointment_urgency" value="{{$appointment-> appointment_urgency}}" required>
                <option value="low">Baixa</option>
                <option value="medium" selected>Média</option>
                <option value="high">Alta</option>
                <option value="urgent">Urgente</option>
            </select>
        </label>
        <label>
            Nome do médico:
            <input type="text" id="doctor_name" name="doctor_name" value="{{$appointment-> doctor_name}}" required>
        </label>
        <label>
            Profissional atendente:
            <input type="text" id="attending_professional" name="attending_professional" value="{{$appointment-> attending_professional}}" required>
        </label>
        <input type="submit" name="Marcar atendimento"/>
    </form>
</body>
</html>