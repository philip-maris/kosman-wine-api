<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderItem extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_items';
    protected $primaryKey ='orderItemId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderItemOrderId',
        'orderItemProductId',
        'orderItemQuantity',
        'orderItemTotalAmount',
        'orderItemStatus',
    ];

    public function orders():BelongsTo
    {
        return $this->belongsTo(Order::class,'orderItemOrderId', 'orderId');
    }
}
