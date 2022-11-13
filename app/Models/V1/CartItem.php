<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = "cart_items";
    protected $primaryKey = "cartItemId";

    protected $fillable =[
        "cartItemCartId",
        "cartItemProductId",
        "cartItemQuantity",
        "cartItemTotalAmount",
        "cartItemStatus",
    ];

    public function cartSummaries(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CartSummary::class, "cartSummaryId", "cartItemId");
    }

    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cart::class, "cartItemCartId", "cartId");
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, "cartItemProductId", "productId");
    }
}
