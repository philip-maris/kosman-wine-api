<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultDeliveryFee extends Model
{
    use HasFactory;

    protected $fillable =[
        'defaultDeliveryFee',
        'defaultDeliveryState',
        'defaultDeliveryStatus',
    ];
}
