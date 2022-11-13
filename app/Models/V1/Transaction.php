<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Transaction extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'transactions';
    protected $primaryKey ='transactionId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transactionCustomerId',
        'transactionOrderId',
        'transactionAmount',
        'transactionPaymentReference',
        'transactionPaymentMethod',
        'transactionStatus',
    ];

    protected $casts = [
    ];

    public function customers(){
        return $this->belongsTo(Customer::class, "transactionCustomerId", "customerId");
    }

    public function orders(){
        return $this->belongsTo(Order::class, "transactionOrderId", "orderId");
    }
}
