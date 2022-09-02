<?php

namespace App\Http\Requests\Admin\NewPostCalculator;

use Illuminate\Foundation\Http\FormRequest;

class Calculate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'CitySender' => ['required', 'array'],
            'CitySender.Ref' => ['required', 'string'],
            'CityRecipient' => ['required', 'array'],
            'CityRecipient.Ref' => ['required', 'string'],
            'ServiceType' => ['required', 'array'],
            'ServiceType.Ref' => ['required', 'string'],
            'CargoType' => ['required', 'array'],
            'CargoType.Ref' => ['required', 'string'],

        ];
    }
}
