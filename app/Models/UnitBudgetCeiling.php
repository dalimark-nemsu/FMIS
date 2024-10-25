<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBudgetCeiling extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'campus_budget_ceiling_id',
        'budget_year_id',
        'operating_unit',
        'pap_id',
        'ps',
        'mooe',
        'co',
        'total_amount',
        'processed_by',
        'is_posted'
    ];

    protected $casts = [
        'is_posted' => 'boolean'
    ];

    public function campusBudgetCeiling()
    {
        return $this->belongsTo(CampusBudgetCeiling::class, 'campus_budget_ceiling_id');
    }

    public function operatingUnit()
    {
        return $this->belongsTo(Unit::class, 'operating_unit');
    }

    public function budgetYear()
    {
        return $this->belongsTo(BudgetYear::class, 'budget_year_id');
    }

    public function programActivityProject()
    {
        return $this->belongsTo(ProgramActivityProject::class, 'pap_id');
    }

    public function scopeIsPosted($query)
    {
        return $query->where('is_posted', true);
    }
}
