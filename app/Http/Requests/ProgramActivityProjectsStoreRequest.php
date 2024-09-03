<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramActivityProjectsStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'code'                   =>          'required',
            'fund_source_id'         =>          'required|numeric',
            'mfo_id'                 =>          'required|numeric',
            'name'                   =>          'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'code.required'                 =>          'The code field is required.',
            'fund_source_id.required'       =>          'The fund source ID is required.',
            'fund_source_id.numeric'        =>          'The fund source ID must be a number.',
            'mfo_id.required'               =>          'The MFO ID is required.',
            'mfo_id.numeric'                =>          'The MFO ID must be a number.',
            'name.required'                 =>          'The name field is required.',
            'name.string'                   =>          'The name must be a string.',
            'name.max'                      =>          'The name may not be greater than 255 characters.',
        ];
    }
}
