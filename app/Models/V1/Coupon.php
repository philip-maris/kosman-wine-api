<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Coupon extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'coupons';
    protected $primaryKey ='couponId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'couponCode',
        'couponValue',
        'couponStatus',
    ];

    protected $casts = [
    ];
}
