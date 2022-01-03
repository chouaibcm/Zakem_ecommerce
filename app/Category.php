<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name','status',
    ];
    

    public function products(){
        return $this->hasMany(Product::class);
    }
}
