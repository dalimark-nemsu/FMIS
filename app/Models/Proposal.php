<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_budget_ceiling_id',
        'proponent_id',
        'created_by',
        'type',
        'title',
        'description',
        'purpose',
        'participants_beneficiaries',
        'expected_output',
    ];

    /**
     * Get the unitBudgetCeiling that owns the Proposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitBudgetCeiling(): BelongsTo
    {
        return $this->belongsTo(UnitBudgetCeiling::class, 'unit_budget_ceiling_id');
    }
}
