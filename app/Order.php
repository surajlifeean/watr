<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function tests(){

    	return $this->belongsToMany(Test::class);
    }
}
