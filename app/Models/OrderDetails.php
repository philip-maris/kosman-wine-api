<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderDetails extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_details';
    protected $primaryKey ='orderDetailsId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderDetailsFirstName',
        'orderDetailsLastName',
        'orderDetailsOrderId',
        'orderDetailsEmail',
        'orderDetailsPhone',
        'orderDetailsAddress',
        'orderDetailsState',
        'orderDetailsStatus',
    ];

    public function orders():BelongsTo
    {
        return $this->belongsTo(Order::class,'orderDetailsOrderId', 'orderId');
    }
}
