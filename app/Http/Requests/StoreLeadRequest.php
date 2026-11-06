<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'service_type' => ['required', 'string', 'max:100'],
            'budget' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:2000'],
            'website_hp' => ['nullable', 'string', 'max:0'], // Honeypot must remain completely empty
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap atau nama bisnis wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi agar kami dapat menghubungi Anda.',
            'message.required' => 'Mohon jelaskan secara singkat kebutuhan website Anda.',
            'website_hp.max' => 'Spam terdeteksi.',
        ];
    }
}
