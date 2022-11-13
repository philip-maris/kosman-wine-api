<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderDetail extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'order_details';
    protected $primaryKey ='orderDetailId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orderDetailFirstName',
        'orderDetailLastName',
        'orderDetailOrderId',
        'orderDetailEmail',
        'orderDetailPhone',
        'orderDetailAddress',
        'orderDetailState',
        'orderDetailStatus',
    ];

    public function orders():BelongsTo
    {
        return $this->belongsTo(Order::class,'orderDetailOrderId', 'orderId');
    }
}
