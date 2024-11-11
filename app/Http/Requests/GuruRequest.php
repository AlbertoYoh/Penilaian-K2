<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
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
            'nama' => 'required',
            'email' => 'required|email|unique:gurus,email',
            'kelas' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama guru tidak boleh kosong yaa...',
            'email.required' => 'Email tidak boleh kosong yaa...',
            'kelas.required' => 'Kelas tidak boleh kosong yaa...',
            'email.unique' => 'Maaf email sudah digunakan yaa...',
        ];
    }
}
