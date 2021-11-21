<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'nb_coupon','discount','min_price', 'status', 
    ];
}
