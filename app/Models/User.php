<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function materias()
    {
        return $this->hasMany(Subject::class, 'docente_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isDocente(): bool
    {
        return $this->role === 'docente';
    }
}
