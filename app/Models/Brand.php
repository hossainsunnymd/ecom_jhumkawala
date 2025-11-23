<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable=['name','image','slug'];
}
