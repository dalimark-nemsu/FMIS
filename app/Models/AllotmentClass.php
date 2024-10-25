<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotmentClass extends Model
{
    use HasFactory;
       protected $fillable = [
        'abbreviation',
        'name',
    ];

    public function objectExpenditures()
    {
        return $this->hasMany(ObjectExpenditure::class, 'allotment_class_id');
    }

}
