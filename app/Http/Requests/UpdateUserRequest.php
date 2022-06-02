<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
            'lastName' => 'required|string|max:40',
            'email' => 'required|string|email|max:40',
            'phone_number' => 'required|string|max:12|min:9',
            'birthday' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vardas yra privalomas',
            'name.max' => 'Vardas negali būti ilgesnis nei 40 simbolių',
            'lastName.required' => 'Pavardė yra privaloma',
            'lastName.max' => 'Pavardė negali būti ilgesnis nei 40 simbolių',
            'email.required' => 'El. paštas yra privalomas',
            'email.email' => 'El. paštas turi būti teisingo formato',
            'email.max' => 'El. paštas negali būti ilgesnis nei 40 simbolių',
            'phone_number.required' => 'Telefono numeris yra privalomas',
            'phone_number.max' => 'Telefono numeris negali būti ilgesnis nei 12 simbolių',
            'phone_number.min' => 'Telefono numeris negali būti ilgesnis nei 9 simboliai',
        ];
    }
}
