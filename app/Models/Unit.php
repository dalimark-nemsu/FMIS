<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    // use SoftDeletes;

    // protected $connection = 'mysql2';

    protected $fillable = [
        'abbreviation',
        'name',
        'campus_id',
    ];

    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'operating_unit');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function majorFinalOutputs()
    {
        return $this->belongsToMany(MajorFinalOutput::class, 'major_final_output_unit');
    }


    public function paps()
    {
        return $this->belongsToMany(ProgramActivityProject::class, 'pap_unit', 'unit_id', 'pap_id')
            ->withTimestamps();
    }

    

    public function unitBudgetCeilings()
    {
        return $this->hasMany(UnitBudgetCeiling::class, 'operating_unit');
    }

    /**
     * Scope to filter units by whether they have a unit budget ceiling for a specific budget year.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $budgetYearId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasUnitBudgetCeilingForYear($query, $campusBudgetCeilingId)
    {
        return $query->whereHas('unitBudgetCeilings', function ($q) use ($campusBudgetCeilingId) {
            $q->where('campus_budget_ceiling_id', $campusBudgetCeilingId);
        })->exists();
    }
}
