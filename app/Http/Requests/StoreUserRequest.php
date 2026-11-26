<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $r = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'name'     => [$r, 'string', 'max:255'],
            'email'    => [$r, 'email', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'password' => [$r, 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi',
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format email tidak valid',
            'email.unique'      => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 8 karakter',
        ];
    }
}