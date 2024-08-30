<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetYearUpdateRequest extends FormRequest
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
            'year'              =>          'required|integer|digits:4',
            'status'            =>          'required|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            'year.required'     =>          'The year field is required.',
            'year.integer'      =>          'The year must be a number.',
            'year.digits'       =>          'The year must be exactly 4 digits.',
            'status.required'   =>          'The status field is required.',
            'status.in'         =>          'The status must be either active or inactive.',
        ];
    }
}
