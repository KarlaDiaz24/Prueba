<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscripcion_id',
        'calificacion'
    ];

    public function inscripcion()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'inscripcion_id');
    }
}

