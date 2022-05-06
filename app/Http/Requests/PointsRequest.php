<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PointsRequest extends FormRequest
{
    public function authorize(): bool
    {
       if (Auth::user()->role == 3) {
           return true;
       }

       return false;
    }

    public function rules(): array
    {
        return [
            'points' => 'required|integer|min:0|max:20',
        ];
    }
}
