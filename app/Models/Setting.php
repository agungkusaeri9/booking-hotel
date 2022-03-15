<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $guarded = ['id'];

    public function logo(){
        if($this->logo == NULL){
            return asset('assets/dist/img/user2-160x160.jpg');
        }else{
            return asset('storage/'.$this->logo);
        }
    }
}
