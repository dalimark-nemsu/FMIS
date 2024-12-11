<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundSource extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'abbreviation',
        'name',
    ];

    public function budgetTypes()
    {
        return $this->hasMany(BudgetType::class);
    }

    public function subFunds()
    {
        return $this->hasMany(SubFund::class);
    }

    public function schoolFeeClassifications()
    {
        return $this->hasMany(SchoolFeeClassification::class);
    }
    
    public function programActivityProjects()
    {
        return $this->hasMany(ProgramActivityProject::class);
    }
}
