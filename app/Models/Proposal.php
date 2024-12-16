<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'unit_budget_ceiling_id',
        'operating_unit',
        'budget_year_id',
        'proposal_type',
        'proposal_title',
        'proposal_proponent_id',
        'proposal_description',
        'proposal_purpose',
        'proposal_participants_beneficiaries',
        'proposal_expected_output',
        'created_by',
    ];

    public function operatingUnit()
    {
        return $this->belongsTo(Unit::class, 'operating_unit');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'proposal_id');
    }
}
