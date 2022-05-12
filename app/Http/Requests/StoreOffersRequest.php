<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffersRequest extends FormRequest
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
            'service_name' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'price_content' => 'required',
            'category_id' => 'required',
            'city' => 'required',
        ];
    }
}
