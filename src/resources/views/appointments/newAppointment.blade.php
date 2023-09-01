<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <title>Criar atendimento</title>
</head>
<body>
    <header>
        <h1>Criar atendimento</h1>

        <div id="doctor-date-query">
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
    </header>

    <div class="alerts">
        @if($errors->any())
        Por favor, corrija os seguintes erros para criar o atendimento:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form action="{{route('appointment.createAppointment')}}" method="post" class="appointment-form">
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
            <input type="text" id="reason" name="reason">
        </label>
        <label>
            Data do atendimento:
            <input type="date" value="{{$date}}" disabled>
            <input type="hidden" id="date" name="date" value="{{$date}}">
        </label>
        <label>
            Horário do atendimento:
            <select type="text" id="time" name="time" required>
                @foreach($availableTimes as $time)
                    <option value="{{$time}}">{{$time}}</option>
                @endforeach
            </select>   
        </label>
        <label>
            Urgência do atendimento:
            <select id="urgency" name="urgency" required>
                <option value="Baixa">Baixa</option>
                <option value="Média" selected>Média</option>
                <option value="Alta">Alta</option>
                <option value="Urgente">Urgente</option>
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
                    <option value="{{$attending_professional -> name}}">{{$attending_professional -> name}}</option>
                @endforeach
            </select>
        </label>
        <input type="submit" name="submit" value="Marcar atendimento"/>
    </form>
</body>
</html>