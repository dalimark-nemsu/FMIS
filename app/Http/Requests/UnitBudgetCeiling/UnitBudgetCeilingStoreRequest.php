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
                $unitPSUnAllocatedTotal = $this->budgetCeilingCalculation->getUnitPSTotalUnallocated($campusBudgetCeiling);
                if (floatval(str_replace(',', '', $this->ps)) > $unitPSUnAllocatedTotal) {
                    $fail('You have exceeded the allocated PS budget for this paps.');
                }
            }],
            'mooe' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                $unitMOOEUnAllocatedTotal = $this->budgetCeilingCalculation->getUnitMOOETotalUnallocated($campusBudgetCeiling);
                if (floatval(str_replace(',', '', $this->mooe)) > $unitMOOEUnAllocatedTotal) {
                    $fail('You have exceeded the allocated MOOE budget for this paps.');
                }
            }],
            'co' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                $unitCOUnAllocatedTotal = $this->budgetCeilingCalculation->getUnitCOTotalUnallocated($campusBudgetCeiling);
                if (floatval(str_replace(',', '', $this->co)) > $unitCOUnAllocatedTotal) {
                    $fail('You have exceeded the allocated CO budget for this paps.');
                }
            }],
            'total' => [
                'sometimes',
                'required',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
                'min:0',
                function ($attribute, $value, $fail) use ($campusBudgetCeiling) {
                    $unitUnAllocatedTotal = $this->budgetCeilingCalculation->getUnitTotalUnallocated($campusBudgetCeiling);
                    if (floatval(str_replace(',', '', $this->total)) > $unitUnAllocatedTotal) {
                        $fail('You have exceeded the allocated budget for this paps.');
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
            'unit.unique' => 'This unit already has a budget allocated for the selected paps.',
            
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
            'total.exceeded' => 'You have exceeded the allocated budget for this paps.'
        ];
    }
}
