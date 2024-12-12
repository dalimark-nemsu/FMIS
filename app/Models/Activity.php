<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'proposal_id',
        'activity_sequence',
        'activity_title',
        'activity_date_schedule',
        'activity_venue',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function budgetaryRequirements()
    {
        return $this->morphMany(BudgetaryRequirement::class, 'itemable');
    }

    protected static function booted()
    {
        static::deleting(function ($activity) {
            $activity->budgetaryRequirements()->delete();
        });
    }
}
