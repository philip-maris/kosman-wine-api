<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Testimony extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'testimonies';
    protected $primaryKey ='testimonyId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'testimonyCustomerId',
        'testimonyContent',
        'testimonyStatus',
    ];

    protected $casts = [
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'testimonyCustomerId', 'customerId');
    }
}
