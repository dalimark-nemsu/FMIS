<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function unitBudgetCeiling()
    {
        return $this->belongsTo(UnitBudgetCeiling::class, 'unit_budget_ceiling_id');
    }
}
