<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Puedes agregar lógica de autorización aquí si es necesario
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'enrollment_id' => 'required|exists:enrollments,id',
            'grade' => 'required|integer|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'enrollment_id.required' => 'El ID de la inscripción es requerido.',
            'enrollment_id.exists' => 'La inscripción seleccionada no existe.',
            'grade.required' => 'La calificación es requerida.',
            'grade.integer' => 'La calificación debe ser un número entero.',
            'grade.min' => 'La calificación mínima es 0.',
            'grade.max' => 'La calificación máxima es 100.',
        ];
    }
}
