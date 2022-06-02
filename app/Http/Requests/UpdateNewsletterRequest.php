<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pavadinimas yra privalomas',
            'name.string' => 'Pavadinimas turi būti tekstas',
            'name.max' => 'Pavadinimas negali būti ilgesnis nei 50 simbolių',
            'content.required' => 'Turinys yra privalomas',
        ];
    }
}
