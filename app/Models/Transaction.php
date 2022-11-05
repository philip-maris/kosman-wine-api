<?php

namespace App\Models;

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
        'transactionAmount',
        'transactionPaymentId',
        'transactionPaymentMethod',
        'transactionStatus',
    ];

    protected $casts = [
    ];
}
