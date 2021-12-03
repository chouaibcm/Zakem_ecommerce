<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactinf extends Model
{
    protected $fillable = [
        'address','phone','email','logo1','logo2'
    ];
    protected $appends = ['logo1_path','logo2_path'];

    public function getLogo1PathAttribute()
       {
           return asset('uploads/logo/' . $this->logo1);
       }
       
       public function getLogo2PathAttribute()
       {
           return asset('uploads/logo/' . $this->logo2);
       }
}
