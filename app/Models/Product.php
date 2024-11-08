<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'photo',
        'product_description',
        'uom',
        'price',
        'remarks',
        'is_available',
        'source'
    ];

    protected $casts = [
        'is_available'  =>  'boolean'
    ];

    /**
     * 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_product', 'product_id', 'product_category_id');
    }
}
