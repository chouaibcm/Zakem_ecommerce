<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'value', 'product_id', 'product_att_id'
    ];

    public function productAtts(){
        return $this->belongsTo(ProductAtt::class, 'product_att_id');
    }
}
