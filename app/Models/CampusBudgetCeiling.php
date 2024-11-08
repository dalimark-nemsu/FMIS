<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampusBudgetCeiling extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'campus_id',
        'budget_year_id',
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

    public function unitBudgetCeilings()
    {
        return $this->hasMany(UnitBudgetCeiling::class, 'campus_budget_ceiling_id');
    }

    public function postedUnitBudgetCeilings()
    {
        return $this->hasMany(UnitBudgetCeiling::class, 'campus_budget_ceiling_id')->where('is_posted', true);
    }

    public function programActivityProject()
    {
        return $this->belongsTo(ProgramActivityProject::class, 'pap_id');
    }

    public function fundSource()
    {
        return $this->belongsTo(FundSource::class, 'fund_source_id');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function budgetYear()
    {
        return $this->belongsTo(BudgetYear::class, 'budget_year_id');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function scopeIsPosted($query)
    {
        return $query->where('is_posted', true);
    }
}
