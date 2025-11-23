<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $fillable=[
        'order_id',
        'user_id',
        'name',
        'phone',
        'pincode',
        'state',
        'city',
        'address',
        'locality',
        'landmark',

    ];
}
