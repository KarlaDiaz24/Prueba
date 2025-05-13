<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Nombre' => $this->Nombre,
            'Apellido' => $this->Apellido,
            'Matricula' => $this->Matricula,
            'Grupo' => $this->Grupo,
            'Semestre' => $this->Semestre,
            'email' => $this->email,
            'Fecha_nacimiento' => $this->Fecha_nacimiento,
        ];
    }
}
