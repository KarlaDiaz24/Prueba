<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'docente_id'];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'materia_id');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Student::class, 'registrations')
            ->withTimestamps();
    }

    public function calificaciones()
    {
        return $this->hasManyThrough(Rating::class, Registration::class);
    }
}

