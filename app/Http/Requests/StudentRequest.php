<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'matricula' => 'required|string|unique:students,matricula',
            'correo' => 'required|email|unique:students,correo',
            'grupo' => 'required|string|max:50',
            'semestre' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
        ];
    }
}
