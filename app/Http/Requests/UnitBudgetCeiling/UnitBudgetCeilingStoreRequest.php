<?php

namespace App\Http\Requests\UnitBudgetCeiling;

use App\Helpers\BudgetCeilingCalculation;
use App\Models\CampusBudgetCeiling;
use App\Services\UnitBudgetCeiling\UnitBudgetCeilingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitBudgetCeilingStoreRequest extends FormRequest
{
    protected BudgetCeilingCalculation $budgetCeilingCalculation;
    public function __construct(BudgetCeilingCalculation $budgetCeilingCalculation)
    {
        $this->budgetCeilingCalculation = $budgetCeilingCalculation;
    }
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
        $campusBudgetCeiling = CampusBudgetCeiling::find($this->campus_budget_ceiling);
 
        return [
            'unit' => [
                'required',
                'max:255',
                Rule::unique('unit_budget_ceilings', 'operating_unit')->where(function ($query) use ($campusBudgetCeiling) {
                    return $query->where('campus_budget_ceiling_id', $campusBudgetCeiling->id);
                })
            ],
            'ps' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                $unitPSUnAllocatedTotal = $campusBudgetCeiling->ps - $campusBudgetCeiling->unitBudgetCeilings->sum('ps');
                if (floatval(str_replace(',', '', $this->ps)) > $unitPSUnAllocatedTotal) {
                    $fail('The :attribute exceeds the assigned budget limit for this PAPS.');
                }
            }],
            'mooe' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                $unitMOOEUnAllocatedTotal = $campusBudgetCeiling->mooe - $campusBudgetCeiling->unitBudgetCeilings->sum('mooe');
                if (floatval(str_replace(',', '', $this->mooe)) > $unitMOOEUnAllocatedTotal) {
                    $fail('The :attribute exceeds the assigned budget limit for this PAPS.');
                }
            }],
            'co' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                $unitCOUnAllocatedTotal = $campusBudgetCeiling->co - $campusBudgetCeiling->unitBudgetCeilings->sum('co');
                if (floatval(str_replace(',', '', $this->co)) > $unitCOUnAllocatedTotal) {
                    $fail('The :attribute exceeds the assigned budget limit for this PAPS.');
                }
            }],
            'total' => [
                'sometimes',
                'required',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
                'min:0',
                function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                    $unitUnAllocatedTotal = $campusBudgetCeiling->total_amount - $campusBudgetCeiling->unitBudgetCeilings->sum('total_amount');
                    if (floatval(str_replace(',', '', $this->total)) > $unitUnAllocatedTotal) {
                        $fail('The :attribute exceeds the assigned budget limit for this PAPS.');
                    }
                }
            ]
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unit.required' => 'The unit name is required.',
            'unit.max' => 'The unit name cannot exceed 255 characters.',
            'unit.unique' => 'This unit already has a budget assigned for the selected paps.',
            
            'ps.required' => 'Please enter the PS (Personnel Services) amount.',
            'ps.regex' => 'The PS amount must be a valid monetary value.',
            'ps.min' => 'The PS amount cannot be negative.',
            
            'mooe.required' => 'Please enter the MOOE (Maintenance and Other Operating Expenses) amount.',
            'mooe.regex' => 'The MOOE amount must be a valid monetary value.',
            'mooe.min' => 'The MOOE amount cannot be negative.',
            
            'co.required' => 'Please enter the CO (Capital Outlay) amount.',
            'co.regex' => 'The CO amount must be a valid monetary value.',
            'co.min' => 'The CO amount cannot be negative.',
            
            'total.required' => 'Please enter the total budget amount.',
            'total.regex' => 'The total budget must be a valid monetary value.',
            'total.min' => 'The total budget cannot be negative.',
        ];
    }
}
