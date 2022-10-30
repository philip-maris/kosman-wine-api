<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'notifications';
    protected $primaryKey ='notificationId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'notificationMessage',
        'notificationColor',
        'notificationCustomerType',
        'notificationCustomerId',
        'notificationTittle',
        'notificationStatus',
    ];

    protected $casts = [
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'notificationUserId', 'customerId');
    }
}
