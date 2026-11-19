<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateEateryRequest extends StoreEateryRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $eatery = $this->route('eatery');
        $rules = parent::rules();
        $rules['name'] = ['required', 'string', 'max:100', Rule::unique('eateries')->ignore($eatery)];
        $rules['permit_no'] = [
            'required', 'regex:/^DVO-\d{4}-\d{4,5}$/',
            Rule::unique('permits')->ignore($eatery->permit),
        ];

        return $rules;
    }

    public function messages(): array
    {
        return parent::messages();
    }
}
