<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectExpenditure extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uacs_code',
        'allotment_class_id',
        'short_description',
        'is_applicable_to_regular_operating_exp',
        'is_active',
    ];

    protected $casts = [
        'is_applicable_to_regular_operating_exp' => 'boolean',
        'is_active' => 'boolean', // Automatically cast `is_active` to boolean
    ];

    public function allotmentClass()
    {
        return $this->belongsTo(AllotmentClass::class, 'allotment_class_id');
    }
    

}
