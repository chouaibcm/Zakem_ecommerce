<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAtt extends Model
{
    protected $fillable = [
        'products_id','sku','size', 'stock',
    ];
    public function product()
       {
           return $this->belongsTo(Product::class);

       }
    
}
