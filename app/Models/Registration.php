<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id',
        'materia_id'
    ];

    public function estudiante()
    {
        return $this->belongsTo(\App\Models\Student::class, 'estudiante_id');
    }
    public function materia()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'materia_id');
    }
    public function rating()
    {
        return $this->hasOne(\App\Models\Rating::class, 'inscripcion_id');
    }

}
