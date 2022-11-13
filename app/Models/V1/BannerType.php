<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerType extends Model
{
    use HasFactory;
    protected $table ="banner_types";
    protected $primaryKey ="bannerTypeId";

    protected $fillable=[
        "bannerTypeBannerId",
        "bannerTypeName",
        "bannerTypeStatus",
    ];

    public function banners(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Banner::class, "bannerTypeBannerId", "bannerId");
    }
}
