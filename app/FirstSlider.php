<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FirstSlider extends Model
{
    use HasTranslations;
    public $translatable = ['heading','description'];

    protected $fillable = [
        'heading','description','image', 'position',
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
       {
           return asset('uploads/carousel/' . $this->image);
       }
}
