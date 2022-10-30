<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subscription extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'subscriptions';
    protected $primaryKey ='subscriptionId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subscriptionCustomerId',
        'subscriptionStatus',
    ];

    protected $casts = [
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'subscriptionCustomerId', 'customerId');
    }
}
