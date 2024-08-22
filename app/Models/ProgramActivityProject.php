<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramActivityProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'fund_source_id',
        'mfo_id',
        'name',
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
}
