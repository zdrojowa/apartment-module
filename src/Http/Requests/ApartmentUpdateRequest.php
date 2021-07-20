<?php

namespace Selene\Modules\ApartmentModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'rooms_count' => 'required|numeric|min:1',
            'number' => 'required|string|max:250',
            'floor' => 'required|numeric',
            'area' => 'required|numeric|min:1',
            'terrace_area' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'To pole jest wymagane.',
            '*.string' => 'To pole wymaga podania wartosci alfanumerycznej.',
            '*.numeric' => 'To pole wymaga podania wartosci numerycznej.',
            '*.max' => 'To pole może zawierać maksymalnie 250 znaków.',
            '*.min' => 'Wprowadzona wartość jest za mała',
        ];
    }
}
