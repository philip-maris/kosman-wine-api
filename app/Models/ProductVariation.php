<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    use HasFactory;
    protected $table = 'product_variations';
    protected $primaryKey = 'productVariationId';
    protected $fillable =[
        'productVariationSize',
        'productVariationStatus'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'productVariationId', 'productVariationId');
    }
}
