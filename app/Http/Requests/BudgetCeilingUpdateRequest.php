<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetCeilingUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */

    protected function prepareForValidation()
    {
        $this->merge([
            'ps' => str_replace(',', '', $this->input('ps')),
            'mooe' => str_replace(',', '', $this->input('mooe')),
            'co' => str_replace(',', '', $this->input('co')),
            'total' => str_replace(',', '', $this->input('total')),
        ]);
    }

    public function rules()
    {
        return [
            'pap'                         =>          'required',
            'ps'                          =>          'sometimes|numeric|min:0|max:900000000',
            'mooe'                        =>          'sometimes|numeric|min:0|max:900000000',
            'co'                          =>          'sometimes|numeric|min:0|max:900000000',
            'total'                       =>          'sometimes|numeric|min:0|max:900000000',
        ];
    }

    public function messages()
    {
        return [
            'pap.required'                  =>          'The program, activity, projects is required.',
            'ps.sometimes'                  =>          'The personal services field is required.',
            'ps.numeric'                    =>          'The personal services field must be a number.',
            'ps.min'                        =>          'The personal services field must be at least :min.',
            'ps.max'                        =>          'The personal services field must not exceed :max.',
            'mooe.sometimes'                =>          'The maintenance and other operating expenses field is required.',
            'mooe.numeric'                  =>          'The maintenance and other operating expenses field must be a number.',
            'mooe.min'                      =>          'The maintenance and other operating expenses field must be at least :min.',
            'mooe.max'                      =>          'The maintenance and other operating expenses field must not exceed :max.',
            'co.sometimes'                  =>          'The capital outlay field is required.',
            'co.numeric'                    =>          'The capital outlay field must be a number.',
            'co.min'                        =>          'The capital outlay field must be at least :min.',
            'co.max'                        =>          'The capital outlay field must not exceed :max.',
            'total.sometimes'               =>          'The total field is required.',
            'total.numeric'                 =>          'The total field must be a number.',
            'total.min'                     =>          'The total field must be at least :min.',
            'total.max'                     =>          'The total field must not exceed :max.',
        ];
    }
}
