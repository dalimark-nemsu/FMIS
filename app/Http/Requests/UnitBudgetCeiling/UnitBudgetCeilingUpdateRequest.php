<?php

namespace App\Http\Requests\UnitBudgetCeiling;

use App\Helpers\BudgetCeilingCalculation;
use App\Models\CampusBudgetCeiling;
use App\Models\UnitBudgetCeiling;
use App\Rules\BudgetLimit;
use App\Services\UnitBudgetCeiling\UnitBudgetCeilingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitBudgetCeilingUpdateRequest extends FormRequest
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
        $unitBudgetCeiling = UnitBudgetCeiling::find($this->unitBudgetCeilingId);
        $campusBudgetCeiling = CampusBudgetCeiling::find($unitBudgetCeiling->campus_budget_ceiling_id);
        return [
            'unit' => ['required','max:255', Rule::unique('unit_budget_ceilings', 'operating_unit')
                    ->where(function ($query) {
                        return $query->where('id', $this->unitBudgetCeilingId);
                    })
                    ->ignore($this->unitBudgetCeilingId) // Ignore current record during uniqueness check
            ],
            'ps' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', new BudgetLimit($campusBudgetCeiling->ps, $this->budgetCeilingCalculation->getUnitPSTotalAllocated($campusBudgetCeiling), $unitBudgetCeiling->ps)],
            'mooe' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', new BudgetLimit($campusBudgetCeiling->mooe, $this->budgetCeilingCalculation->getUnitMOOETotalAllocated($campusBudgetCeiling), $unitBudgetCeiling->mooe)],
            'co' => ['sometimes', 'nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/', 'min:0', new BudgetLimit($campusBudgetCeiling->co, $this->budgetCeilingCalculation->getUnitCOTotalAllocated($campusBudgetCeiling), $unitBudgetCeiling->co)],
            'total' => ['sometimes', 'required','regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/','min:0', new BudgetLimit($campusBudgetCeiling->total_amount, $this->budgetCeilingCalculation->getUnitTotalAllocated($campusBudgetCeiling), $unitBudgetCeiling->total_amount)]
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
