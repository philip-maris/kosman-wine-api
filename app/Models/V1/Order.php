<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'orders';
    protected $primaryKey ='orderId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderCustomerId',
        'orderDeliveryId',
        'orderTotalAmount',
        'orderReference',
        'orderPaymentMethod',
        'orderSubTotalAmount',
        'orderStatus',
    ];

    public function delivery():HasOne
    {
        return $this->hasOne(Delivery::class,'orderDeliveryId', 'deliveryId');
    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class,'orderItemOrderId', 'orderItemId');
    }

    public function orderDetails(): HasOne
    {
        return $this->hasOne(OrderDetail::class,'orderDetailOrderId', 'orderDetailId');
    }


    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'orderCustomerId', 'customerId');
    }


}
