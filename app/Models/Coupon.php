<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['name','code', 'type', 'value', 'cart_value', 'expiry_date'];
}
