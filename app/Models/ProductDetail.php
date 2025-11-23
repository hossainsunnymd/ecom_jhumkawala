<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductDetail extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable=['product_id','description','image1','image2','image3','image4'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
