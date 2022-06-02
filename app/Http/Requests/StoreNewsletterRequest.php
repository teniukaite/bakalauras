<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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
