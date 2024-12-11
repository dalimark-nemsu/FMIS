<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityProject extends Model
{
    protected $fillable = [
        'code',
        'mfo_id',

        'fund_source_id',
        'budget_type_id',
        'sub_fund_id',
        'school_fee_classification_id',
        'pap_type_id',
        'parent_id',
        'name'
    ];

    public function campusBugetCeilings()
    {
        return $this->hasMany(CampusBudgetCeiling::class, 'pap_id');
    }

    public function unitBudgetCeilings()
    {
        return $this->hasMany(UnitBudgetCeiling::class, 'pap_id');
    }

    public function majorFinalOutput()
    {
        return $this->belongsTo(MajorFinalOutput::class, 'mfo_id');
    }

    public function fundSource()
    {
        return $this->belongsTo(FundSource::class, 'fund_source_id');
    }

    public function budgetType()
    {
        return $this->belongsTo(BudgetType::class, 'budget_type_id');
    }

    public function subFund()
    {
        return $this->belongsTo(SubFund::class, 'sub_fund_id');
    }

    public function schoolFeeClassification()
    {
        return $this->belongsTo(SchoolFeeClassification::class, 'school_fee_classification_id');
    }

    public function papType()
    {
        return $this->belongsTo(PapType::class, 'pap_type_id');
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'pap_unit');
    }

}
