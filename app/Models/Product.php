<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable=[
        'category_id',
        'brand_id',
        'name',
        'slug',
        'short_description',
        'price',
        'discount',
        'discount_price',
        'SKU',
        'stock_status',
        'featured',
        'flash_sales',
        'popular',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function details()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function wishlists()
    {
        return $this->hasMany(ProductWish::class);
    }
}
