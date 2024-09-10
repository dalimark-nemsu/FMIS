<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'abbreviation',
        'name',
        'campus_id',
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function majorFinalOutputs()
    {
        return $this->belongsToMany(MajorFinalOutput::class, 'major_final_output_unit');
    }
    
}
