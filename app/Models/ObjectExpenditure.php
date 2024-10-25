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
        'is_active',
    ];


    public function allotmentClass()
    {
        return $this->belongsTo(AllotmentClass::class, 'allotment_class_id');
    }
    

}
