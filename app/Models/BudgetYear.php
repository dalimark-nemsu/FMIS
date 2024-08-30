<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetYear extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'year',
        'is_active',
    ];

    public function campusBudgetCeilings()
    {
        return $this->hasMany(CampusBudgetCeiling::class);
    }

    public function unitBudgetCeilings()
    {
        return $this->hasMany(UnitBudgetCeiling::class);
    }
}
