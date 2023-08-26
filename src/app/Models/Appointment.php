<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_cpf',
        'patient_sus_card',
        'appointment_reason',
        'appointment_urgency',
        'doctor_name',
        'attending_professional'
    ];
}
