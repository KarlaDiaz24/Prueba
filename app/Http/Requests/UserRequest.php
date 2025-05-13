<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user')->id : null;
        $rules = [
            'name'         => ['required'],
            'email'        => ['required', 'unique:users,email,' . $userId],
            'role'         => ['required'],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string'];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['password'] = ['nullable', 'string'];
        }
        return $rules;
    }
}
