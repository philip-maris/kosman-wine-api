<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartSummary extends Model
{
    use HasFactory;

    protected $fillable =[
        'cartSummaryCartId',
        'cartSummarySubTotal',
        'cartSummaryVat',
        'cartSummaryDeliveryFee',
        'cartSummaryTotal',
    ];
}
