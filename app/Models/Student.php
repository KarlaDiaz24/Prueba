<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'matricula',
        'correo',
        'grupo',
        'semestre',
        'fecha_nacimiento',
    ];

    public function inscripciones()
    {
        return $this->hasMany(Registration::class);
    }

    public function materias()
    {
        return $this->belongsToMany(Subject::class, 'inscripciones')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function calificaciones()
    {
        return $this->hasManyThrough(
            \App\Models\Rating::class,
            \App\Models\Registration::class,
            'estudiante_id',
            'inscripcion_id',
            'id',
            'id'          
        );
    }

}
