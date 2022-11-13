<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartSummary extends Model
{
    use HasFactory;

    protected $table = "cart_summaries";
    protected $primaryKey = "cartSummaryId";

    protected $fillable =[
        'cartSummaryCartId',
        'cartSummarySubTotal',
        'cartSummaryVat',
        'cartSummaryDeliveryFee',
        'cartSummaryTotal',
        'cartSummaryCartItemId',
        'cartSummaryStatus',
    ];

    public function carts(){
        return $this->belongsTo(Cart::class, "cartSummaryCartId", "cartId");
    }

    public function cartItems(){
        return $this->belongsTo(CartItem::class, "cartSummaryCartItemId", "cartItemId");
    }
}
