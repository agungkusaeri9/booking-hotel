<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function image(){
        return asset('storage/'.$this->image);
    }
    
    public function price()
    {
        return $this->hasOne(ProductPrice::class);
    }
}
