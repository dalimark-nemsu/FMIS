<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'unit_budget_ceiling_id',
        'operating_unit',
        'budget_year_id',
        'proposal_type',
        'proposal_title',
        'proposal_proponent_id',
        'proposal_description',
        'proposal_purpose',
        'proposal_participants_beneficiaries',
        'proposal_expected_output',
        'created_by',
    ];

    public function operatingUnit()
    {
        return $this->belongsTo(Unit::class, 'operating_unit');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'proposal_id');
    }

    public function budgetYear()
    {
        return $this->belongsTo(BudgetYear::class);
    }

    // Accessor to calculate total cost
    public function getTotalCostAttribute()
    {
        return $this->activities->flatMap(function ($activity) {
            return $activity->budgetaryRequirements;
        })->sum(function ($budgetaryRequirement) {
            return $budgetaryRequirement->quantity * $budgetaryRequirement->unit_cost;
        });
    }
}
