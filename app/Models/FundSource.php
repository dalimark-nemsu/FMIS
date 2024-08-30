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

    public function paps()
    {
        return $this->hasMany(ProgramActivityProject::class);
    }
}
