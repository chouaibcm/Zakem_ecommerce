<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    protected $fillable = [
        'facebook','instagram','google', 'twitter','pinterest','youtube'
    ];
}
