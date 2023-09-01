<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendingProfessional extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function appointment(): BelongsTo
    {
        return $this->BelongsTo(Appointment::class);
    }
}
