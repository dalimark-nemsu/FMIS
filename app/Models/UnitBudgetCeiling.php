<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBudgetCeiling extends Model
{
    use HasFactory;

    protected $fillable = [
        'campus_budget_ceiling_id',
        'operating_unit',
        'pap_id',
        'ps',
        'mooe',
        'co',
        'processed_by',
    ];

    public function campusBudgetCeiling()
    {
        return $this->belongsTo(CampusBudgetCeiling::class, 'campus_budget_ceiling_id');
    }

    public function operatingUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
