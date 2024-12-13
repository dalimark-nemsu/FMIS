<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetaryRequirement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'itemable_type',
        'itemable_id',
        'general_description',
        'uom',
        'quantity',
        'unit_cost',
        'procurement_mode_id',
        'object_expenditure_id',
        'unit_budget_ceiling_id',
    ];

    public function itemable()
    {
        return $this->morphTo();
    }
}
