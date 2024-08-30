<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajorFinalOutput extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'abbreviation',
        'name'
    ];

    public function programActivityProjects()
    {
        return $this->hasMany(ProgramActivityProject::class, 'mfo_id');
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'mfo_id');
    }
}
