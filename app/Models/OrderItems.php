<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderItems extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_items';
    protected $primaryKey ='orderItemsId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderItemsOrderId',
        'orderItemsProductId',
        'orderItemsQuantity',
        'orderItemsTotalAmount',
        'orderItemsStatus',
    ];

    public function orders():BelongsTo
    {
        return $this->belongsTo(Order::class,'orderItemsOrderId', 'orderId');
    }
}
