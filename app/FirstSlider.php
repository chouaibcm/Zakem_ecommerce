<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstSlider extends Model
{
    protected $fillable = [
        'heading','description','image', 
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
       {
           return asset('uploads/carousel/' . $this->image);
       }
}
