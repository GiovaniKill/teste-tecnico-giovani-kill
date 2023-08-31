<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_cpf',
        'patient_sus_card',
        'reason',
        'date',
        'time',
        'urgency',
        'doctor_id',
        'attending_professional_id'
    ];

    public function doctor(): HasMany
    {
        return $this->hasMany(Doctor::class, 'id');
    }

    public function attendingProfessional(): HasMany
    {
        return $this->hasMany(AttendingProfessional::class, 'id');
    }
}
