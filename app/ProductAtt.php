<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAtt extends Model
{
    protected $fillable = [
        'name',
    ];

       public function attr_values(){
        return $this->hasMany(AttributeValue::class);
       }
    
}
