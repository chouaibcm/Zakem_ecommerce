<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    protected $fillable = [
        'image', 'product_id',
    ];
    protected $appends = ['image_path'];


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImagePathAttribute()
       {
           return asset('uploads/product_img/' . $this->image);
       }
}
