<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BudgetLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $assignedBudget;
    protected $totalAllocated;
    protected $currentValue;

    public function __construct($assignedBudget, $totalAllocated, $currentValue)
    {
        $this->assignedBudget = $assignedBudget;
        $this->totalAllocated = $totalAllocated;
        $this->currentValue = $currentValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Calculate the difference and current total
        $diff = $this->totalAllocated - (float) $this->currentValue;
        $currentTotal = $diff + (float) str_replace(',', '', $value);

        // Check if the new total exceeds the allocated amount
        return $currentTotal <= $this->assignedBudget;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute exceeds the assigned budget limit for this PAPS. The total assigned budget is {$this->assignedBudget}.";
    }
}
