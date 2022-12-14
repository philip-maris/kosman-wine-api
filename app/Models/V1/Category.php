<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $primaryKey = "categoryId";

    protected $fillable =[
        "categoryName",
        "categoryStatus"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'productCategoryId', 'categoryId');
    }
}
