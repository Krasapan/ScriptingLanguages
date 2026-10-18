<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BetaTesterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $testerId = $this->route('beta_tester')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:beta_testers,email,' . $testerId],
            'age' => ['required', 'integer', 'min:12', 'max:100'],
            'platform' => ['required', 'string', 'max:100'],
            'experience' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
