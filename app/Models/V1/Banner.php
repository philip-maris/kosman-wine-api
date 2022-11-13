<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Banner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'banners';
    protected $primaryKey ='bannerId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bannerImage',
        'bannerTitle',
        'bannerStatus',
    ];

    protected $casts = [
    ];

    public function bannerType(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BannerType::class, "bannerTypeBannerId", "bannerTypeId");
    }
}
