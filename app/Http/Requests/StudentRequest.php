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
            'Nombre' => 'required|string|max:255',
            'Apellido' => 'required|string|max:255',
            'Matricula' => 'required|string|max:255|unique:students,Matricula',
            'Grupo' => 'required|string|max:255',
            'Semestre' => 'required|integer|min:1|max:12',
            'email' => 'required|email|max:255|unique:students,email',
            'Fecha_nacimiento' => 'required|date'
        ];
    }
}
