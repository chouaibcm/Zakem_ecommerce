<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title','name','p_code', 'description', 'price','status','image','category_id'
    ];

    protected $appends = ['image_path'];



       public function category()
       {
           return $this->belongsTo(Category::class);

       }
       public function attr_values(){
        return $this->hasMany(AttributeValue::class,'product_id');
       }

       public function getImagePathAttribute()
       {
           return asset('uploads/product_img/' . $this->image);
       }
       
       public function orders()
       {
        return $this->belongsToMany(Order::class, 'product_order');
       }//end of orders

       public function reviews()
       {
        return $this->hasMany(Review::class);
       }

       
}
