<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['fund_source_id', 'name'];

    public function fundSource()
    {
        return $this->belongsTo(FundSource::class);
    }
    
}
