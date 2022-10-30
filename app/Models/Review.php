<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Review extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'reviews';
    protected $primaryKey ='reviewId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reviewRating',
        'reviewProductId',
        'reviewStatus',
    ];

    protected $casts = [
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'reviewProductId', 'productId');
    }
}
