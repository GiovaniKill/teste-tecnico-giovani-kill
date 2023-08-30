<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar atendimento</title>
</head>
<body>
    <h1>Criar atendimento</h1>

    <div>
        @if($errors->any())
        Por favor, corrija os seguintes erros para criar o atendimento:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{route('appointment.createAppointment')}}" method="post">
        @csrf
        @method('post')
        <label>
            Nome:
            <input type="text" id="patient_name" name="patient_name" required>
        </label>
        <label>
            CPF:
            <input type="number" id="patient_cpf" name="patient_cpf" maxlength="14" placeholder="123.456.789-00" required>
        </label>
        <label>
            Cartão SUS:
            <input type="number" id="patient_sus_card" name="patient_sus_card" required>
        </label>
        <label>
            Motivo do atendimento:
            <input type="text" id="appointment_reason" name="appointment_reason">
        </label>
        <label>
            Urgência do atendimento:
            <select id="appointment_urgency" name="appointment_urgency" required>
                <option value="low">Baixa</option>
                <option value="medium" selected>Média</option>
                <option value="high">Alta</option>
                <option value="urgent">Urgente</option>
            </select>
        </label>
        <label>
            Nome do médico:
            <input type="text" id="doctor_name" name="doctor_name" required>
        </label>
        <label>
            Profissional atendente:
            <input type="text" id="attending_professional" name="attending_professional" required>
        </label>
        <input type="submit" name="Marcar atendimento"/>
    </form>
</body>
</html>