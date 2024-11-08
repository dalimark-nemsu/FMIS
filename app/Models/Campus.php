<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function campusBudgetCeilings()
    {
        return $this->hasMany(CampusBudgetCeiling::class);
    }

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }

    public function allBudgetsPosted()
    {
        // Get the total count of campus budget ceilings for this campus
        $totalBudgets = $this->campusBudgetCeilings()->count();

        // Get the count of posted campus budget ceilings for this campus
        $postedBudgets = $this->campusBudgetCeilings()->where('is_posted', true)->count();

        // Return true if all budgets are posted
        return $totalBudgets > 0 && $totalBudgets === $postedBudgets;
    }
}
