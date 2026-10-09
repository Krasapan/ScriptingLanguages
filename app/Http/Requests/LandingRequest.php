<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Будь ласка, вкажіть своє ім\'я.',
            'email.required' => 'Для зв\'язку потрібен ваш Email.',
            'email.email'    => 'Введіть коректну адресу електронної пошти.',
            'message.max'    => 'Повідомлення занадто довге (макс. 1000 символів).'
        ];
    }
}
