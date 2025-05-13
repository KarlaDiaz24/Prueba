<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'Nombre' => $this->Nombre,
                'Codigo' => $this->Codigo,
                'Docente_id' => $this->Docente_id,
                'Docente' => new UserResource($this->docente),
            ];
    }
}
